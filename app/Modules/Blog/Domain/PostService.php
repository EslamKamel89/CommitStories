<?php

namespace App\Modules\Blog\Domain;

use App\Modules\Blog\DTOs\PostData;
use App\Modules\Blog\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostService {
    public function create(PostData $data): Post {
        Cache::flush();
        return Post::create($data->toCreateArray());
    }
    public function update(Post $post,  PostData $data): Post {
        Cache::flush();
        $post->update($data->toUpdateArray());
        return $post->refresh();
    }
    public function delete(Post $post) {
        Cache::flush();
        return $post->delete();
    }
}
