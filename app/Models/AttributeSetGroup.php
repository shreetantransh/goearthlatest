<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeSetGroup extends Model
{
    protected $fillable = ['name', 'attribute_set_id'];

    public function getName()
    {
        return ucwords($this->name);
    }

    public function attributeSet()
    {
        return $this->belongsTo(AttributeSet::class, 'attribute_set_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)->withPivot('attribute_set_id');
    }
}
