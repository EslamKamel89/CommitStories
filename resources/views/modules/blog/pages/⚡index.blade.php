<?php

use App\Modules\Blog\Actions\ListPublishedPosts;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    #[Url]
    public $category_id;

    #[Computed]
    public function posts() {
        return app(ListPublishedPosts::class)
            ->execute($this->category_id, 10);
    }
};
?>


<div class="min-h-screen bg-gradient-to-b from-gray-50/10 to-gray-100/10 dark:from-gray-900/10 dark:to-gray-950/10">
    <div class="max-w-5xl mx-auto py-12 px-6">

        <div class="flex items-center justify-between mb-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-gray-100 tracking-tight">
                Blog Posts
            </h1>

            <flux:button
                wire:navigate
                href="{{ route('blogs.create') }}"
                class="px-5 py-2.5 rounded-xl bg-gray-900 text-white text-sm font-semibold shadow-sm hover:bg-gray-800 hover:shadow-md active:scale-[0.98] transition-all duration-200 ease-out focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 dark:bg-gray-100 dark:text-gray-900 dark:hover:bg-gray-200">
                Add Blog
            </flux:button>
        </div>

        <div class="space-y-6">
            @foreach ($this->posts as $post)
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200">
                <livewire:modules::blog.components.post-card
                    :post="$post"
                    wire:key="post-{{ $post->id }}" />
            </div>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center">
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl px-4 py-3 shadow-sm">
                {{ $this->posts->links() }}
            </div>
        </div>

    </div>
</div>