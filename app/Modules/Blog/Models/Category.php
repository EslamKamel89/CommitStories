<?php

namespace App\Modules\Blog\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model {
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    protected static function newFactory(): CategoryFactory {
        return  CategoryFactory::new();
    }
    public function posts(): HasMany {
        return $this->hasMany(Post::class);
    }
}
