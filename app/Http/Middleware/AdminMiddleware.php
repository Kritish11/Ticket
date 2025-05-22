<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('is_admin')) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login first to access the admin panel.');
        }
        return $next($request);
    }
}
