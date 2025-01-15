<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label',
        'category',
        'content',
        'type',
        'preview_image',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}