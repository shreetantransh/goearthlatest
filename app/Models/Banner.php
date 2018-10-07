<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    const IMAGE_PATH = 'banners';

    protected $fillable = ['title', 'content', 'url', 'button_title', 'sequence', 'is_active', 'image'];

    public function getImageUrl()
    {
        return storage_path('app/' . $this->image);
    }

    public function hasBannerImage()
    {
        $filePath = $this->getImageUrl();
        return $this->image && file_exists($filePath) && is_file($filePath);
    }

    public function getImage($width = 100, $height = 100)
    {
        return asset(\Image::url($this->image, $width, $height, array('crop')));
    }

    public function scopeActive()
    {
        return $this->where('is_active', TRUE);
    }

}
