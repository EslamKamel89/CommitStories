<?php

namespace App\Modules\Blog\Actions;

use App\Modules\Blog\Domain\PostService;
use App\Modules\Blog\DTOs\PostData;
use App\Modules\Blog\Models\Post;
use Illuminate\Support\Facades\Gate;

class UpdatePost {
    public function __construct(
        protected PostService $service,
    ) {
    }

    public function execute(Post $post,  PostData $dto) {
        // Gate::authorize('update' , $post);
        return $this->service->update($post, $dto);
    }
}
