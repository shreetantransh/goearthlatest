<?php

namespace App\Models;

use App\Exceptions\InvalidImageSizeException;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    const UPLOAD_DIR = 'product/images/';

    const IMAGE_SMALL = 'small';
    const IMAGE_MEDIUM = 'medium';
    const IMAGE_THUMBNAIL = 'thumbnail';
    const IMAGE_FULL = 'full';
    const IMAGE_ZOOM = 'full_xl';
    const BANNER = 'banner';
    const VERY_SMALL = 'very_small';

    const IMAGE_RATIO = .6;

    protected $fillable = [
        'label', 'image', 'sequence'
    ];

    public static function boot()
    {
//        static::deleting(function ($model) {
//            unlink(storage_path('app/' . $model->attributes['image']));
//        });
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getUrl($size = self::IMAGE_FULL)
    {
        $sizes = [
            'full' => [700, 500],
            'thumbnail' => [270, 264],
            'medium' => [600, 300],
            'small' => [200, 200],
            'full_xl' => [1200, 500],
            'banner' => [2850, 250],
            'very_small' => [110, 90]
        ];

        if (empty($sizes[$size])) {
            throw new InvalidImageSizeException();
        }

        list($width, $height)  = $sizes[$size];

        $newHeight =  ($width * self::IMAGE_RATIO);

        return url(\Image::url($this->image, $width, $height, ['crop']));
    }
}
