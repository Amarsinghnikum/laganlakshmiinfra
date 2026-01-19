<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\VisitorLog;
use Illuminate\Support\Facades\Http;

class TrackVisitors
{
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $agent = new Agent();

        $visitorHash = md5($ip . $agent->browser() . $agent->platform() . $agent->device());

        $alreadyVisited = VisitorLog::where('visitor_hash', $visitorHash)
            ->where('visited_at', '>=', now()->subHours(24))
            ->exists();

        if (!$alreadyVisited) {
            $country = null;
            $region = null;
            $city = null;

            try {
                $location = Http::timeout(2)->get("http://ip-api.com/json/{$ip}")->json();

                $country = $location['country'] ?? null;
                $region  = $location['regionName'] ?? null;
                $city    = $location['city'] ?? null;

            } catch (\Exception $e) {
                // Skip error (do nothing)
            }

            VisitorLog::create([
                'visitor_hash' => $visitorHash,
                'ip' => $ip,
                'country' => $country,
                'region' => $region,
                'city' => $city,
                'browser' => $agent->browser(),
                'platform' => $agent->platform(),
                'device' => $agent->device(),
                'visited_at' => now(),
                'path' => $request->path(),
            ]);
        }

        return $next($request);
    }
}
