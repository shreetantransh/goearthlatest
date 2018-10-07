<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function getName($limit = 250)
    {
        return str_limit($this->name, $limit);
    }
}
