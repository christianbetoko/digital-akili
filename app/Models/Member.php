<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'role',
        'bio',
        'linkedin',
        'twitter',
        'instagram',
        'facebook',
        'image',
        'status'
    ];
    protected $casts = [
       
        'status' => 'boolean',
    ];
}
