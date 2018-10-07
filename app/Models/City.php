<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeHasState($query, $state)
    {
        return $query->where('state_id', $state);
    }

    public function getName($limit = 250)
    {
        return str_limit($this->name, $limit);
    }
}
