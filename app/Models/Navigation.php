<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'position',
        'is_active',
        'page_type_id',
        'icon',
        'short_content',
        'main_content',
        'banner',
    ];

    /**
     * Self-referencing relationship to get children navigations
     */
    public function children()
    {
        return $this->hasMany(Navigation::class, 'parent_id')->orderBy('position');
    }

    /**
     * Optional: get parent navigation
     */
    public function parent()
    {
        return $this->belongsTo(Navigation::class, 'parent_id');
    }

    /**
     * Relationship with PageType
     */
    public function pageType()
    {
        return $this->belongsTo(PageType::class, 'page_type_id');
    }
}
