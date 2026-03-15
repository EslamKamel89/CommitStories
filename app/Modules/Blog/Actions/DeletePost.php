<?php

namespace App\Modules\Blog\Actions;

use App\Modules\Blog\Domain\PostService;
use App\Modules\Blog\Models\Post;
use Illuminate\Support\Facades\Gate;

class DeletePost {
    public function __construct(
        protected PostService $service,
    ) {
    }
    public function execute(Post $post) {
        Gate::authorize('delete', $post);
        return $this->service->delete($post);
    }
}
