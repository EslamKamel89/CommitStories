<?php

use App\Modules\Blog\Actions\CreatePost;
use App\Modules\Blog\Actions\UpdatePost;
use App\Modules\Blog\DTOs\PostData;
use App\Modules\Blog\Models\Category;
use App\Modules\Blog\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    public Post $post;

    #[Validate('required|string|max:255')]
    public String $title;

    #[Validate('required|exists:categories,id')]
    public int $category_id;

    #[Validate('required|string')]
    public String $content;

    #[Validate('required|boolean')]
    public bool $is_published = false;


    public function save() {
        $data = $this->validate();
        app(UpdatePost::class,)
            ->execute($this->post, PostData::fromUpdateRequest($data, $this->post->published_at));
        return redirect()->route('blogs.index');
    }

    public function mount() {
        $this->title = $this->post->title;
        $this->category_id = $this->post->category_id;
        $this->content = $this->post->content;
        $this->is_published = $this->post->is_published;
    }
    /**
     * Summary of categories
     * @return Collection<int, string>
     */
    public function categories(): Collection {
        return Category::pluck('name', 'id');
    }
};
?>

<div class="max-w-3xl mx-auto py-10 space-y-6">
    <flux:input label="Title" wire:model="title" />

    <flux:select label="Category" wire:model="category_id">
        @foreach($this->categories() as $id => $name)
        <option value="{{ $id }}">{{ $name }}</option>
        @endforeach
    </flux:select>

    <flux:textarea label="Content" wire:model="content" />

    <flux:checkbox wire:model="is_published" label="Publish Now" />

    <flux:button wire:click="save">
        Save Post
    </flux:button>
</div>