<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('is_logged_in')) {
            return redirect()->route('login')
                ->with('error', 'Please login to continue.');
        }
        return $next($request);
    }
}
