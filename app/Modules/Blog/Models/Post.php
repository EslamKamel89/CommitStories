<?php

namespace App\Modules\Blog\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Database\Factories\PostFactory;

class Post extends Model {
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    protected $fillable = [
        "user_id",
        "category_id",
        "title",
        "content",
        "is_published",
        "published_at",
    ];
    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime'
    ];
    protected static function newFactory(): PostFactory {
        return  PostFactory::new();
    }
    public function author(): BelongsTo {

        return $this->belongsTo(User::class, 'user_id');
    }
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }
    public function scopePublished(Builder $query): Builder {
        return $query->where('is_published', true)
            ->whereNotNull('published_at');
    }
}
