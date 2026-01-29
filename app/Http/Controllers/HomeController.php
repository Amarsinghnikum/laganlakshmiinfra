<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Newsletter;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function redirectAdmin()
    {
        return redirect()->route('admin.dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::where('is_active', 1)
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->inRandomOrder()
            ->take(8)
            ->get();

        return view('frontend.pages.index', [
            'pageTitle' => 'Hotel Guest Room GRMS Automation | In Out Patient Clinic Management NCS | Smart Home G5 | Lighting Control',
            'pageDescription' => 'Discover advanced solutions in hotel guest room GRMS automation, in/out patient clinic management by NCS, Smart Home G5 systems, and intelligent lighting control technologies for modern living and healthcare environments.',
            'pageKeywords' => 'Curtain and drape motorization, HVAC smart systems, Energy saving solutions, Occupancy sensors, Smart detectors, Fire and gas alarms, Home automation scenes, Smart apartment features, Moods and ambiance control, Wireless home automation, Voice controlled home devices, Smart home integration, NCS clinic management, Smart Home G5, lighting control solutions, smart hotel technology, patient clinic automation, smart building automation, GRMS lighting, healthcare automation',
            'categories' => $categories
        ]);
    }
}