<?php

namespace App\Modules\Blog\DTOs;

use Carbon\Carbon;

class PostData {
    public function __construct(
        public ?int $user_id = null,
        public int $category_id,
        public string $title,
        public string $content,
        public bool $is_published = false,
        public mixed $published_at = null,

    ) {
    }
    /**
     * Summary of fromCreateRequest
     * @param array{
     *  category_id:int,
     *  title:string,
     *  content:string,
     *  is_published?:bool,
     * } $data
     * @param int $userId
     * @return PostData
     */
    public static function fromCreateRequest(array $data, int $userId): self {
        return new self(
            user_id: $userId,
            category_id: $data['category_id'],
            title: $data['title'],
            content: $data['content'],
            is_published: $data['is_published'] ?? false,
            published_at: ($data['is_published'] ?? false) ? Carbon::now() : null,

        );
    }
    /**
     * Summary of fromUpdateRequest
     * @param array{
     *  category_id:int,
     *  title:string,
     *  content:string,
     *  is_published?:bool,
     * } $data
     * @param ?Carbon $existingPublishedAt
     * @return PostData
     */
    public static function fromUpdateRequest(array $data, ?Carbon $existingPublishedAt): self {
        $isPublished = $data['is_published'] ?? false;
        $publishedAt = match (true) {
            $isPublished && $existingPublishedAt === null => Carbon::now(),
            $isPublished && $existingPublishedAt !== null => $existingPublishedAt,
            default => null,
        };
        return new self(
            user_id: null,
            category_id: $data['category_id'],
            title: $data['title'],
            content: $data['content'],
            is_published: $isPublished,
            published_at: $publishedAt,

        );
    }
    public function toCreateArray() {
        return   [
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'content' => $this->content,
            'is_published' => $this->is_published,
            'published_at' => $this->published_at,
        ];
    }
    public function toUpdateArray() {
        return  [
            'category_id' => $this->category_id,
            'title' => $this->title,
            'content' => $this->content,
            'is_published' => $this->is_published,
            'published_at' => $this->published_at,
        ];
    }
}
