<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'images',
        'year',
        'client',
        'partenaire',
        'link',
        'status'
    ];
    protected $casts = [
        'images' => 'array',
        'status' => 'boolean',
        'year' => 'integer'
    ];
}
