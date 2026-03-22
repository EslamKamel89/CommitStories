<?php

namespace App\Modules\Blog\Middleware;

use App\Modules\Blog\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePostOwner {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $post = $request->route('post');
        if (!$post) {
            return $next($request);
        }
        if (!($post instanceof Post)) {
            return $next($request);
        }
        if ($request->user()->id !== $post->user_id) {
            abort(403, 'Unauthorized access to this post');
        }
        return $next($request);
    }
}
