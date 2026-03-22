<?php

namespace App\Modules\Blog\Domain;

use App\Modules\Blog\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class PostQueryService {
    public function listPublished(?int $categoryId = null, int $perPage = 10): LengthAwarePaginator {
        $page = (int)request()->input('page', 1);
        $key = "posts:published:category:{$categoryId}:page:{$page}:per_page:{$perPage}";
        return Cache::remember($key, now()->addHour(),  function () use ($categoryId, $perPage) {

            return Post::query()
                ->published()
                ->with(['category', 'author'])
                ->withCount('comments')
                ->when(
                    $categoryId,
                    fn($q, $v) => $q->where('category_id', $v)
                )->latest()
                ->paginate($perPage);
        });
    }
}
