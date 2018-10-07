<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValueVarchar extends Model
{
    protected $table = 'attribute_value_varchar';

    protected $fillable = ['value'];

    public function productAttribute()
    {
        return $this->morphOne(ProductAttribute::class, 'valuable');
    }
}
