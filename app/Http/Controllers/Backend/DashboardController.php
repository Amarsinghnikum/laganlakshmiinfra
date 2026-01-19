<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\AdminLogin;
use App\Models\UserLogin;
use App\Models\VisitorLog;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['dashboard.view']);

        $user = auth()->user();

        $adminLogins = AdminLogin::with('admin')
            ->latest('login_time')
            ->take(10)
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->admin->name ?? 'N/A',
                    'email' => $item->admin->email ?? 'N/A',
                    'role' => 'Admin',
                    'ip_address' => $item->ip_address,
                    'login_time' => $item->login_time,
                ];
            });

        // Get latest 10 user login records
        $userLogins = UserLogin::with('user')
            ->latest('login_time')
            ->take(10)
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->user->name ?? 'N/A',
                    'email' => $item->user->email ?? 'N/A',
                    'role' => 'User',
                    'ip_address' => $item->ip_address,
                    'login_time' => $item->login_time,
                ];
            });

        $recentVisitors = VisitorLog::where('visited_at', '>=', now()->subDays(7))
            ->select(
                DB::raw('DATE(visited_at) as date'),
                'country',
                'city',
                DB::raw('GROUP_CONCAT(DISTINCT browser ORDER BY browser SEPARATOR ", ") as browser'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy(
                DB::raw('DATE(visited_at)'),
                'country',
                'city'
            )
            ->orderByDesc('total')
            ->get();

        $totalVisitsCount = $recentVisitors->sum('total');

        $recentLogins = $adminLogins
            ->merge($userLogins)
            ->sortByDesc('login_time')
            ->take(10)
            ->values();
        
        return view('backend.pages.dashboard.index', [
            'recentLogins' => $recentLogins,
            'recentVisitors' => $recentVisitors,
            'totalVisitsCount' => $totalVisitsCount
        ]);
    }

    public function Queries()
    {
        $this->checkAuthorization(auth()->user(), ['dashboard.view']);
        
        $contact = Contact::get();
        return view('backend.pages.contact.index',['contact' => $contact]);
    }

    public function queryStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|max:1000',
        ]);

        Contact::create($validated);

        $emailData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => $validated['subject'] ?? 'N/A',
            'userMessage' => $validated['message'] ?? 'N/A',
        ];

        Mail::mailer('gmail2')->send('frontend.emails.query', $emailData, function ($message) use ($emailData) {
            $message->to('smart5gautomation@gmail.com')
                    ->from('smartg5automation@gmail.com', 'Smart 5G Automation')
                    ->subject('Query from Smart 5G - ' . $emailData['name']);
        });

        return response()->json([
            'status' => true,
            'message' => 'Your message has been sent successfully!',
        ]);
    }
}