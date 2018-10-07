<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AttributeValueDate extends Model
{
    protected $table = 'attribute_value_date';

    protected $fillable = ['value'];


    public function setValueAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return $this->attributes['value'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
}
