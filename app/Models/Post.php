<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'category_id','subcategory_id', 'title', 'slug',  'content', 'image_cover', 'status', 'is_featured', 'published_at'
    ];

    protected $casts = ['published_at' => 'datetime', 'status' => 'boolean', 'is_featured' => 'boolean'];

    // Relation avec l'auteur
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relation avec la catégorie
    public function category() {
        return $this->belongsTo(Category::class);
    }

    // Scope pour ne récupérer que les articles en ligne
    public function scopePublished($query) {
        return $query->where('status', 'published')
                     ->where('published_at', '<=', now());
    }
    public function comments() {
    return $this->hasMany(Comment::class)->where('is_visible', true);
}

}
