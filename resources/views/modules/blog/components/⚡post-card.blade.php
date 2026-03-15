<?php

use App\Modules\Blog\Actions\DeletePost;
use App\Modules\Blog\Models\Post;
use Livewire\Component;

new class extends Component {
    public Post $post;

    public function delete() {
        app(DeletePost::class)->execute($this->post);
        return redirect()->route('blogs.index');
    }
};
?>

<article
    class="group p-7 rounded-2xl border shadow-sm transition-all duration-200
           bg-white border-gray-200 hover:shadow-lg hover:-translate-y-0.5
           dark:bg-gray-900 dark:border-gray-700 dark:hover:shadow-xl">

    <div class="flex items-start justify-between gap-4 mb-3">
        <h2 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-gray-100 group-hover:text-gray-700 dark:group-hover:text-gray-200 transition-colors">
            {{ $post->title }}
        </h2>

        <div class="flex items-center gap-2 shrink-0">
            @can('update' , $post)
            <flux:button
                icon="pencil"
                wire:navigate
                href="{{ route('blogs.edit' , $post->id) }}"
                class="bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-200 rounded-lg px-3 py-2 transition" />
            @endcan
            @can('delete' , $post)
            <flux:button
                icon="trash"
                wire:click="delete"
                wire:confirm="Are you sure you want to delete this post"
                class="bg-red-50 hover:bg-red-100 text-red-600 dark:bg-red-900/30 dark:hover:bg-red-900/50 dark:text-red-400 rounded-lg px-3 py-2 transition" />
            @endcan
        </div>
    </div>

    <div class="text-xs md:text-sm mb-4 flex flex-wrap gap-3 text-gray-500 dark:text-gray-400">

        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-gray-100 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            Author: {{ $post->author->name }}
        </span>

        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-gray-100 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            Category: {{ $post->category->name }}
        </span>

        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-gray-100 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            {{ $post->comments_count }} comments
        </span>

    </div>

    <p class="leading-relaxed text-sm md:text-[15px] text-gray-700 dark:text-gray-300">
        {{ Str::limit($post->content, 160) }}
    </p>

</article>