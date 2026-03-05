<?php

namespace App\Modules\Blog\Domain;

use App\Modules\Blog\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

class PostQueryService {
    public function listPublished(?int $categoryId = null, int $perPage = 10): LengthAwarePaginator {
        return Post::query()
            ->published()
            ->with(['category', 'author'])
            ->withCount('comments')
            ->when(
                $categoryId,
                fn($q, $v) => $q->where('category_id', $v)
            )->latest()
            ->paginate($perPage);
    }
}
