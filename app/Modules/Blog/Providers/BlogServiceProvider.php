<?php

namespace App\Modules\Blog\Providers;

use App\Modules\Blog\Models\Post;
use App\Modules\Blog\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider {
    /**
     * Register services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {
        Gate::policy(Post::class, PostPolicy::class);
    }
}
