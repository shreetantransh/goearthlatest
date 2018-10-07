<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name', 'image', 'comment', 'sequence', 'status'];

    const IMAGE_UPLOAD_PATH = 'testimonial/images/';

    public function hasImage()
    {
        return (bool) file_exists(storage_path('app/' . $this->image));
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeSequenced($query)
    {
        return $query->orderBy('sequence', 'desc');
    }

    public function getImageUrl($width = 70, $height = 70)
    {
        return asset(\Image::url($this->image, $width, $height, ['crop']));
    }

    public function getImage()
    {
        return storage_path('app/' . $this->image);
    }

    public function deleteImage()
    {
        if($this->hasImage())
            return \File::delete($this->getImage());
    }

    public function getName()
    {
        return ucwords($this->name);
    }

}
