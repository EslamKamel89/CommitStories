<?php

namespace App\Modules\Blog\Domain;

use App\Modules\Blog\DTOs\PostData;
use App\Modules\Blog\Models\Post;

class PostService {
    public function create(PostData $data): Post {
        return Post::create($data->toCreateArray());
    }
    public function update(Post $post,  PostData $data): Post {
        $post->update($data->toUpdateArray());
        return $post->refresh();
    }
    public function delete(Post $post) {
        return $post->delete();
    }
}
