<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email', 'mobile', 'address', 'street', 'landmark', 'city_id', 'state_id', 'country', 'pincode', 'is_default', 'gender'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }


}
