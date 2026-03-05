<?php

namespace Database\Factories;

use App\Modules\Blog\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Modules\Blog\Models\Comment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Blog\Models\Comment>
 */
class CommentFactory extends Factory {
    protected $model = Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            "user_id" => User::factory(),
            "post_id" => Post::factory(),
            "body" => $this->faker->sentence(),
        ];
    }
}
