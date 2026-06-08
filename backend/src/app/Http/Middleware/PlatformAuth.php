<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Platform;

class PlatformAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $key = $request->bearerToken() ?? $request->header("X-API-KEY");

        $platform = Platform::where("key", $key)->first();

        if (!$platform) {
            return response()->json(["message" => "Unauthorized"], 401);
        }

        // attach the platform to the request for use in controllers
        $request->merge(["platform" => $platform]);

        return $next($request);
    }
}
