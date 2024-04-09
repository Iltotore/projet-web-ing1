<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EmailVerifiedOnly
{
    /**
     * Specify the redirect route for the middleware.
     *
     * @param  string  $route
     * @return string
     */
    public static function redirectTo($route)
    {
        return static::class.':'.$route;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return JsonResponse|RedirectResponse|Response|null
     */
    public function handle($request, Closure $next, $redirectToRoute = null): mixed
    {
        if(Auth::check() && Auth::user()->hasVerifiedEmail()) return $next($request);
        else {
            Log::info("Expect json: " . ($request->expectsJson() ? "true" : "false"));
            return $request->expectsJson() ? response()->json(["redirect" => "/registered"]) : redirect("/registered");
        }
    }
}
