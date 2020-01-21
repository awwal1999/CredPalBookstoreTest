<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! auth()->user()->hasRole('admin')) {
            return response()->json(['message' => 'You are not allowed to perfom this action'], 401);
        }
        return $next($request);
    }
}
