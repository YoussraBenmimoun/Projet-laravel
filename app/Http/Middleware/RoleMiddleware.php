<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, $role): Response
    // {
    //     if (Auth::check()) {
    //         if (Auth::user()->usertype == $role) {
    //             return $next($request);
    //         } else {
    //             return redirect()->route('user');
    //         }
    //     } else {
    //         return redirect()->route('login'); 
    //     }
    // }
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->usertype == $role) {
            // dd($request);
            return $next($request);
            
        } else {
            return redirect()->route('login');
        }
    }

}
