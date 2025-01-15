<?php

namespace App\Models;

use IbrahimBougaoua\FilamentSortOrder\Traits\SortOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Hyperlink extends Model
{
    use SortOrder;

    protected $guarded = [];

    protected $casts = [
        'open_in_new_tab' => 'boolean',
    ];

    protected $appends = ['is_active'];
    
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function getUrlAttribute($value)
    {
        if ($this->page) {
            return $this->page->full_url;
        }

        return  $value;
    }

    public function getIsActiveAttribute()
    {
        return $this->page && url()->current() === $this->page->full_url;
    }
}
