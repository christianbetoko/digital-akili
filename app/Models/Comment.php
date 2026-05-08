<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['post_id', 'user_name', 'user_email', 'content', 'is_visible'];
protected $casts = [
        'is_visible' => 'boolean',
    ];
    public function post() {
        return $this->belongsTo(Post::class);
    }
}
