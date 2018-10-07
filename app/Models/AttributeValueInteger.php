<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValueInteger extends Model
{
    protected $table = 'attribute_value_integer';

    protected $fillable = ['value'];
}
