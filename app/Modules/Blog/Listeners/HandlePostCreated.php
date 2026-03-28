<?php

namespace App\Modules\Blog\Listeners;

use App\Modules\Blog\Events\PostCreated;
use App\Modules\Blog\Jobs\ProcessPostCreated;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Queue\InteractsWithQueue;

class HandlePostCreated {
    /**
     * Create the event listener.
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostCreated $event): void {
        ProcessPostCreated::dispatch($event->post);
    }
}
