<?php

namespace App\Http\Middleware;

use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful as BaseMiddleware;
use Illuminate\Support\Facades\Auth;

class CustomEnsureFrontendRequestsAreStateful extends BaseMiddleware
{
    protected $stateful = [];

    protected function isStatefulRequest($request)
    {
        return $this->hasValidStatefulDomain($request) ||
               $this->hasValidStatefulPattern($request);
    }

    protected function hasValidStatefulDomain($request)
    {
        $domain = $request->getHost();
        return in_array($domain, $this->stateful);
    }

    protected function hasValidStatefulPattern($request)
    {
        $patterns = $this->stateful;
        foreach ($patterns as $pattern) {
            if (\Illuminate\Support\Str::is($pattern, $request->getHost())) {
                return true;
            }
        }
        return false;
    }

    protected function configureGuard()
    {
        Auth::guard('sanctum')->setDispatcher(app('events'));
    }

    public function handle($request, $next)
    {
        if ($this->isStatefulRequest($request)) {
            $this->configureGuard();
            if (!Auth::guard('sanctum')->check()) {
                if ($request->is('api/*') || $request->expectsJson()) {
                    return response()->json(['message' => 'Unauthenticated.'], 401);
                } else {
                    return redirect()->guest(route('login'));
                }
            }
        }
        return $next($request);
    }
}
