<?php

namespace App\Modules\Blog\Actions;

use App\Modules\Blog\Domain\PostService;
use App\Modules\Blog\DTOs\PostData;
use App\Modules\Blog\Models\Post;
use Illuminate\Support\Facades\Gate;

class CreatePost {
    public function __construct(
        protected PostService $service,
    ) {
    }
    public function execute(PostData $dto) {
        // Gate::authorize('create', Post::class);
        return $this->service->create($dto);
    }
}
