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

<div class="max-w-5xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-8 text-gray-900 dark:text-gray-100">
        Blog Posts
    </h1>

    <div class="space-y-6">

        @foreach ($this->posts as $post)
        <livewire:modules::blog.components.post-card :post="$post" wire:key="post-{{ $post->id }}" />
        @endforeach

    </div>

    <div class="mt-10">
        {{ $this->posts->links() }}
    </div>

</div>