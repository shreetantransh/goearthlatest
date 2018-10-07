<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $table = "product_attributes";

    protected $fillable = [];


    public function getValue()
    {
        switch ($this->type) {
            case 'double' :
                return optional($this->valueDouble)->value;
            case 'integer' :
                return optional($this->valueInteger)->value;
            case 'date' :
                return optional($this->valueDate)->value;
            case 'multiselect' :
                return optional($this->valueVarchars())->pluck('value');
            default :
                return optional($this->valueVarchar)->value;
        }
    }

    public function valueVarchar()
    {
        return $this->hasOne(AttributeValueVarchar::class);
    }

    public function valueVarchars()
    {
        return $this->hasMany(AttributeValueVarchar::class);
    }

    public function valueDouble()
    {
        return $this->hasOne(AttributeValueDouble::class);
    }

    public function valueInteger()
    {
        return $this->hasOne(AttributeValueInteger::class);
    }

    public function valueDate()
    {
        return $this->hasMany(AttributeValueDate::class);
    }

    public function saveValue(Attribute $attribute, $value)
    {
        $attributeValue = null;

        if ($attribute->hasMultiOptions(true)) {

            $savedValues = [];

            foreach ($value as $val) {
                $savedValues[] = $this->valueVarchars()->firstOrCreate(['value' => $val]);
            }

            $this->valueVarchars()->whereNotIn('value', $value)->delete();
            return $savedValues;
        }

        switch ($attribute->type) {
            case 'date':
                $attributeValue = $this->valueDate()->firstOrNew([]);
                break;
            case 'double':
                $attributeValue = $this->valueDouble()->firstOrNew([]);
                break;
            case 'integer':
                $attributeValue = $this->valueInteger()->firstOrNew([]);
                break;
            default:
                $attributeValue = $this->valueVarchar()->firstOrNew([]);

        }

        if ($attributeValue) {

            $attributeValue->value = $value;
            $attributeValue->save();

            $this->save();

            return $attributeValue;
        }

        return false;
    }
}
