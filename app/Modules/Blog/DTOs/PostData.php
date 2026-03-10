<?php

namespace App\Modules\Blog\DTOs;

use Carbon\Carbon;

class PostData {
    public function __construct(
        public int $user_id,
        public int $category_id,
        public string $title,
        public string $content,
        public bool $is_published = false,
        public mixed $published_at = null,

    ) {
    }
    /**
     * Summary of fromArray
     * @param array{
     *  category_id:int,
     *  title:string,
     *  content:string,
     *  is_published?:bool,
     *  published_at?:Carbon,
     * } $data
     * @param int $userId
     * @return PostData
     */
    public static function fromArray(array $data, int $userId): self {
        return new self(
            user_id: $userId,
            category_id: $data['category_id'],
            title: $data['title'],
            content: $data['content'],
            is_published: $data['is_published'] ?? false,
            published_at: $data['published_at'] ?? null,
        );
    }
    public function toArray() {
        return [
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'content' => $this->content,
            'is_published' => $this->is_published,
            'published_at' => $this->published_at,
        ];
    }
}
