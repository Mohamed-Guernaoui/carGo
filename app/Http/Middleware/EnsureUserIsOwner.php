<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            $request->path() === "dashboard" &&
            auth()->user()->role === "client"
        ) {
            return redirect()->route("admin.dashboard");
        }
        // match (auth()->user()->role) {
        //     "client" => redirect()->route("admin.dashboard"),
        //     "owner" => redirect()->route(
        //         "admin.profile"
        //     ), // default => $next($request),
        // };
        return $next($request);
    }
}
