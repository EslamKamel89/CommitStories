<?php

namespace Database\Seeders;

use App\Models\User;
use App\Modules\Blog\Models\Post;
use App\Modules\Blog\Models\Comment;
use App\Modules\Blog\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
        ]);
        $this->seedUsersAndCategories();
        $this->seedPostsWithComments();
    }

    protected function seedUsersAndCategories(): void {
        User::factory()
            ->count(10)
            ->create();

        Category::factory()
            ->count(6)
            ->sequence(
                ['name' => 'Technology'],
                ['name' => 'Business'],
                ['name' => 'Design'],
                ['name' => 'Programming'],
                ['name' => 'Lifestyle'],
                ['name' => 'AI']
            )
            ->create();
    }

    protected function seedPostsWithComments(): void {
        $users = User::all();
        $categories = Category::all();

        Post::factory()
            ->count(80)
            ->make()
            ->each(function ($post) use ($users, $categories) {

                $post->user_id = $users->random()->id;
                $post->category_id = $categories->random()->id;

                $isPublished = fake()->boolean(70);

                $post->is_published = $isPublished;
                $post->published_at = $isPublished
                    ? fake()->dateTimeBetween('-1 year', 'now')
                    : null;

                $post->save();

                if ($isPublished) {
                    $this->seedCommentsForPost($post, $users);
                }
            });
    }

    protected function seedCommentsForPost(Post $post, $users): void {
        $commentCount = fake()->numberBetween(0, 15);

        for ($i = 0; $i < $commentCount; $i++) {

            Comment::factory()->create([
                'post_id' => $post->id,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}
