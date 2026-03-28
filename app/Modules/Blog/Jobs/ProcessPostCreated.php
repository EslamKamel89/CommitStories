<?php

namespace App\Modules\Blog\Jobs;

use App\Modules\Blog\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessPostCreated implements ShouldQueue {
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Post $post
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void {
        sleep(5);
        info('Post processed', [
            'post_id' => $this->post->id,
        ]);
    }
}
