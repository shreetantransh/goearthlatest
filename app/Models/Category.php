<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;

    protected $fillable = ['name', 'slug', 'image', 'description', 'meta_title', 'meta_description', 'meta_keywords', 'is_active', 'parent_id', 'add_to_menu'];

    protected $casts = ['is_active' => 'boolean'];

    const IMAGE_PATH = 'catalog/category/images/';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getName()
    {
        return ucwords($this->name);
    }

    public function getUrl()
    {
        return route('category', $this->slug);
    }

    public function getImageUrl()
    {
        return storage_path('app/' . $this->image);
    }

    public function hasImage()
    {
        $path = $this->getImageUrl();
        return $this->image && file_exists($path) && is_file($path);
    }

    public function scopeActive()
    {
        return $this->where('is_active', true);
    }

    public function scopeAddToMenu($query)
    {
        return $query->where('add_to_menu', true);
    }

    public function scopeRoot($query)
    {
        $query->whereNull('parent_id');
    }

    public function getImage($width = 400, $height = 100, array $options = []): String
    {
        return \Image::url($this->image, $width, $height, ['crop']);
    }

    public function hasChild()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getBannerImage($width = 2250, $height = 250)
    {
        return $this->getImage($width, $height);
    }
}
