<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Check user role and redirect accordingly
            if ($user->usertype === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->usertype === 'client') {
                return redirect()->route('client.dashboard');
            }
        }

        return $next($request);
    }
}
