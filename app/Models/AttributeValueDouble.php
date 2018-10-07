<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValueDouble extends Model
{
    protected $table = 'attribute_value_double';

    protected $fillable = ['value'];
}
