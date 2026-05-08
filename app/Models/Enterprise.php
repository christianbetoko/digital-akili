<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'about',
        'slogan',
        'description',
        'mission',
        'vision',
        'address',
        'phone',
        'email',
        'logo_with_bg',
        'logo_without_bg',
        'website'
    ];
}
