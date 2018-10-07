<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeSet extends Model
{
    protected $fillable = ['name'];

    public function getName()
    {
        return $this->name;
    }

    public function groups()
    {
        return $this->hasMany(AttributeSetGroup::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_attribute_set_group');
    }
}
