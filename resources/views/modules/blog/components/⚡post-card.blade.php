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
    class="group relative p-7 rounded-2xl border shadow-sm transition-all duration-300
           bg-white border-gray-200 hover:shadow-xl hover:-translate-y-1
           dark:bg-gray-900 dark:border-gray-700 dark:hover:shadow-2xl">

    <div class="flex items-start justify-between gap-4 mb-4">
        <h2 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-gray-100 leading-snug group-hover:text-gray-700 dark:group-hover:text-gray-200 transition-colors">
            {{ $post->title }}
        </h2>

        <div class="flex items-center gap-2 shrink-0">
            @can('update' , $post)
            <flux:button
                icon="pencil"
                wire:navigate
                href="{{ route('blogs.edit' , $post->id) }}"
                class="bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-200 rounded-lg px-3 py-2 transition-all duration-200 shadow-sm hover:shadow-md" />
            @endcan

            @can('delete' , $post)
            <flux:button
                icon="trash"
                wire:click="delete"
                wire:confirm="Are you sure you want to delete this post"
                class="bg-red-50 hover:bg-red-100 text-red-600 dark:bg-red-900/30 dark:hover:bg-red-900/50 dark:text-red-400 rounded-lg px-3 py-2 transition-all duration-200 shadow-sm hover:shadow-md" />
            @endcan
            <flux:modal.trigger :name="'post_view_'.$post->id">
                <flux:button
                    variant="primary"
                    class="bg-green-50 hover:bg-green-100 text-green-600 dark:bg-green-900/30 dark:hover:bg-green-900/50 dark:text-green-400 rounded-lg px-3 py-2 transition-all duration-200 shadow-sm hover:shadow-md">
                    <flux:icon.eye />
                </flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    <div class="text-xs md:text-sm mb-5 flex flex-wrap gap-2 text-gray-500 dark:text-gray-400">

        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-gray-100 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            Author: {{ $post->author->name }}
        </span>

        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-gray-100 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            Category: {{ $post->category->name }}
        </span>

        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-gray-100 border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            {{ $post->comments_count }} comments
        </span>

    </div>

    <p class="leading-relaxed text-sm md:text-[15px] text-gray-700 dark:text-gray-300 mb-6">
        {{ Str::limit($post->content, 160) }}
    </p>

    <div class="flex items-center justify-between">


        <span class="text-xs text-gray-400 dark:text-gray-500 opacity-0 group-hover:opacity-100 transition">
            Click to interact
        </span>
    </div>

    <flux:modal :name="'post_view_'.$post->id" class="min-w-[22rem]" flyout position="bottom">
        <div class="space-y-6 p-3">
            <div>
                <flux:heading size="lg" class="text-gray-900 dark:text-gray-100">
                    {{ $post->title }}
                </flux:heading>

                <flux:text class="mt-3 text-gray-600 dark:text-gray-300 leading-relaxed">
                    {{ $post->content }}
                </flux:text>
            </div>

            <div class="flex items-center gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button
                        variant="ghost"
                        class="px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                        Cancel
                    </flux:button>
                </flux:modal.close>
            </div>
        </div>
    </flux:modal>

</article>