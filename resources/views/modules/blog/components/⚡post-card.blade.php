<?php

use App\Modules\Blog\Models\Post;
use Livewire\Component;

new class extends Component {
    public Post $post;
};
?>
<article
    class="p-6 rounded-xl border shadow-sm transition
                       bg-white border-gray-200 hover:shadow-md
                       dark:bg-gray-900 dark:border-gray-700 dark:hover:shadow-lg">
    <h2 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">
        {{ $post->title }}
    </h2>

    <div class="text-sm mb-3 flex flex-wrap gap-4 text-gray-500 dark:text-gray-400">
        <span>
            Author: {{ $post->author->name }}
        </span>

        <span>
            Category: {{ $post->category->name }}
        </span>

        <span>
            {{ $post->comments_count }} comments
        </span>
    </div>

    <p class="leading-relaxed text-gray-700 dark:text-gray-300">
        {{ Str::limit($post->content, 160) }}
    </p>
</article>