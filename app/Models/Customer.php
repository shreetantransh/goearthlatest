<?php

namespace App\Models;

use App\Logic\Customer\Traits\Cart;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Logic\Customer\Traits\WishList;

class Customer extends Authenticatable
{
    use Notifiable, WishList, Cart;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'dob', 'gender', 'mobile', 'password', 'is_guest_customer'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $dates = [
        'dob'
    ];

    public function getFullName()
    {
        return ucwords("{$this->first_name}");
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getDobAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getGenders()
    {
        return collect([
            'Male' => 'Male',
            'Female' => 'Female',
            'Other' => 'Other'
        ]);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
