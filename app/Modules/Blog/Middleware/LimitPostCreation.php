<?php

namespace App\Modules\Blog\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class LimitPostCreation {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $userId = $request->user()->id;
        $key = "post_creation_count_{$userId}";
        $count = Cache::increment($key);
        if ($count === 1 || !$count) {
            Cache::put($key, 1, now()->addMinute());
        }
        if ($count > 5) {
            abort(429, 'Too many posts created. Try again later.');
        }
        return $next($request);
    }
}
