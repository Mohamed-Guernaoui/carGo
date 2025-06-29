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
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            $request->path() === "dashboard" &&
            auth()->guard()->user()->role === "owner"
        ) {
            return redirect()->route("admin.dashboard");
        } elseif (
            $request->path() === "dashboard" &&
            auth()->guard()->user()->role === "client"
        ) {
            return redirect()->route("client.dashboard");
        }

        return $next($request);
    }
}
