<?php

namespace App\Modules\Blog\Actions;

use App\Modules\Blog\Domain\PostService;
use App\Modules\Blog\DTOs\PostData;
use App\Modules\Blog\Events\PostCreated;
// use App\Modules\Blog\Jobs\ProcessPostCreated;
use App\Modules\Blog\Models\Post;
use Illuminate\Support\Facades\Gate;

class CreatePost {
    public function __construct(
        protected PostService $service,
    ) {
    }
    public function execute(PostData $dto) {
        Gate::authorize('create', Post::class);
        $post =  $this->service->create($dto);
        // ProcessPostCreated::dispatch($post);
        event(new PostCreated($post));
        return $post;
    }
}
