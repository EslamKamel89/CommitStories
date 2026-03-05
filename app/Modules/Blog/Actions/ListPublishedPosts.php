<?php

namespace App\Modules\Blog\Actions;

use App\Modules\Blog\Domain\PostQueryService;
use Illuminate\Pagination\LengthAwarePaginator;

class ListPublishedPosts {
    public function __construct(
        protected PostQueryService $service,
    ) {
    }

    public function execute(?int $categoryId = null, int $perPage = 10): LengthAwarePaginator {
        return $this->service->listPublished($categoryId, $perPage);
    }
}
