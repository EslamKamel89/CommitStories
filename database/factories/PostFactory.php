<?php

namespace Database\Factories;

use App\Models\User;
use App\Modules\Blog\Models\Category;
use App\Modules\Blog\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Blog\Models\Post>
 */
class PostFactory extends Factory {
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            // 'user_id' => User::factory(),
            // 'category_id' => Category::factory(),
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'is_published' => $is_published = $this->faker->boolean(),
            'published_at' => $is_published ? $this->faker->dateTimeBetween('-1 year', 'now') : null,
        ];
    }
}
