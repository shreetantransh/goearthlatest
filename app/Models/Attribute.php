<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    const TYPE_TEXT = 'varchar';
    const TYPE_INTEGER = 'integer';
    const TYPE_DOUBLE = 'double';
    const TYPE_DATE = 'date';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_DROPDOWN = 'dropdown';
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_RADIO = 'radio';
    const TYPE_MULTISELECT = 'multiselect';
    const TYPE_IMAGE = 'image';


    const ATTRIBUTE_SKU_CODE = 'sku';
    const ATTRIBUTE_PRICE_CODE = 'price';
    const ATTRIBUTE_SPECIAL_PRICE_CODE = 'special_price';


    protected $fillable = [
        'label',
        'code',
        'type',
        'is_required',
        'is_unique',
        'is_comparable',
        'is_searchable',
        'used_in_product_listing',
        'used_in_product_detail',
        'used_in_product_sorting',
        'sequence',
    ];

    public function getName()
    {
        return ucwords($this->label);
    }

    public function getCode()
    {
        return $this->code;
    }

    public function attributeGroups()
    {
        return $this->belongsToMany(AttributeSetGroup::class);
    }

    public function options()
    {
        return $this->hasMany(AttributeOption::class);
    }

    public function hasMultiOptions($multiValueOnly = false)
    {
        $options = [
            self::TYPE_MULTISELECT,
            self::TYPE_CHECKBOX,
        ];

        if (! $multiValueOnly) {
            $options[] = self::TYPE_DROPDOWN;
        }

        return in_array($this->type, $options);
    }
}
