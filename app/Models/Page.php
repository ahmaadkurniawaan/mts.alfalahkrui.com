<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $fillable = ['title', 'slug', 'html',  'styles', 'project_data', 'content', 'add_to_navbar', 'url', 'is_active'];

    protected $casts = [
        'project_data' => 'array',
        'content' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($page) {
            if (!$page->slug) {
                $page->slug = Str::slug($page->title);
            }

            if ($page->id === 1) {
                $page->url = '';
            } else {
                if ($page->url) {
                    $page->url = ltrim($page->url, '/');
                }
            }
        });
    }

    public function isHomePage()
    {
        return $this->id === 1;
    }

    public function getFullUrlAttribute()
    {
        return route('page.show', $this->url);
    }
}
