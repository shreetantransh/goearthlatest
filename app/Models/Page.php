<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['name', 'slug', 'content', 'template', 'meta_title', 'meta_keywords', 'meta_description', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    const PAGE_TEMPLATE_DEFAULT = 'default';
    const PAGE_TEMPLATE_FRONT_PAGE = 'font_page';

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = strtolower(preg_replace('/([^A-Za-z0-9]+)/', '-', $value));
    }

    public static function getPageTemplates()
    {
        return collect([
            [
                'label' => 'Default Template',
                'value' => self::PAGE_TEMPLATE_DEFAULT
            ],
            [
                'label' => 'Front Page',
                'value' => self::PAGE_TEMPLATE_FRONT_PAGE
            ]
        ]);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function getName()
    {
        return ucwords($this->name);
    }

    public function getContent()
    {
        return $this->content;
    }
}
