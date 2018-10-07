<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    use Notifiable;

    const LOGO_PATH = '/logo';

    protected $fillable = [
        'first_name', 'last_name', 'username', 'name',  'email', 'password', 'image', 'footer_logo', 'contact_number', 'contact_number_other', 'address', 'address_other', 'facebook', 'google', 'twitter', 'youtube', 'linked_in'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function getName()
    {
        return ucwords($this->first_name . ' ' . $this->last_name);
    }

    public function getLogoUrl()
    {
        return storage_path('app/' . $this->image);
    }

    public function hasLogo()
    {
        $filePath = $this->getLogoUrl();
        return $this->image && file_exists($filePath) && is_file($filePath);
    }

    public function getLogo($width = 100, $height = 100)
    {
        return asset(\Image::url($this->image, $width, $height, array('crop')));
    }

    public function getFooterLogoUrl()
    {
        return storage_path('app/' . $this->footer_logo);
    }

    public function hasFooterLogo()
    {
        $filePath = $this->getLogoUrl();
        return $this->footer_logo && file_exists($filePath) && is_file($filePath);
    }

    public function getFooterLogo($width = 100, $height = 100)
    {
        return asset(\Image::url($this->footer_logo, $width, $height, array('crop')));
    }
}
