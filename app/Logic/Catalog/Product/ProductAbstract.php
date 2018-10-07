<?php
/**
 * Created by PhpStorm.
 * Customer: bay
 * Date: 3/6/2018
 * Time: 3:18 PM
 */

namespace App\Logic\Catalog\Product;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductAttribute;

trait ProductAbstract
{

    public static function saveAttributes(Product $product, array $attributeValues)
    {
        $attributes = $product->attributeSet->attributes()->whereIn('code', array_keys($attributeValues))->get();

        $typeAttributePairs = $attributes->pluck('id')->toArray();

        $product->attributes()->syncWithoutDetaching($typeAttributePairs);

        $attributes->map(function (Attribute $attribute) use ($product, $attributeValues) {

            /* @var $productAttribute ProductAttribute */
            $productAttribute = $product->productAttributes()->where('attribute_id', $attribute->id)->first();
            $productAttribute->saveValue($attribute, $attributeValues[$attribute->code]);
        });
    }

    public function scopeSetRelationship($query)
    {
        $query->select('products.*')->join('product_attributes', 'product_attributes.product_id', 'products.id')
            ->join('attributes', 'attributes.id', '=', 'product_attributes.attribute_id')
            ->leftJoin('attribute_value_varchar', function ($join) {
                $join->on('attribute_value_varchar.product_attribute_id', '=', 'product_attributes.id')
                    ->on(function ($join) {
                        $join->on('attributes.type', \DB::raw("'varchar'"))
                            ->orOn('attributes.type', \DB::raw("'dropdown'"))
                            ->orOn('attributes.type', \DB::raw("'textarea'"));
                    });
            })
            ->leftJoin('attribute_value_date', function ($join) {
                $join->on('attribute_value_date.product_attribute_id', '=', 'product_attributes.id')->on('attributes.type', \DB::raw("'date'"));
            })
            ->leftJoin('attribute_value_double', function ($join) {
                $join->on('attribute_value_double.product_attribute_id', '=', 'product_attributes.id')->on('attributes.type', \DB::raw("'double'"));
            })
            ->leftJoin('attribute_value_integer', function ($join) {
                $join->on('attribute_value_integer.product_attribute_id', '=', 'product_attributes.id')->on('attributes.type', \DB::raw("'integer'"));
            })->groupBy('products.id');
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    /**
     * @param $method
     * @param $parameters
     * @return null
     */
    public function __call($method, $parameters)
    {
        if (!method_exists($this, $method) && strpos($method, 'get') === 0) {

            $code = camelToText(str_replace('get', '', $method));
            return $this->getData($code);
        }

        return parent::__call($method, $parameters);
    }

    public function setData($code, $value)
    {
        $this->attributeValues[$code] = $value;
    }

    public function getData($code = false)
    {
        if ($this->attributeData == null) {
            $this->attributeData = $this->attributes()->pluck('attribute_value', 'code');
        }

        if ($code == false) {
            return $this->attributeData;
        }

        return isset($this->attributeData[$code]) ? $this->attributeData[$code] : null;
    }

    public function scopeAddAttributeToFilter($query, $attribute, $condition, $value)
    {
                if ($condition == 'IN') {
            return $query->havingRaw("MAX(CASE WHEN attributes.code = '{$attribute}' THEN 
                 (CASE attributes.type
                    WHEN 'varchar' THEN attribute_value_varchar.value
                    WHEN 'textarea' THEN attribute_value_varchar.value
                    WHEN 'dropdown' THEN attribute_value_varchar.value
                    WHEN 'date' THEN attribute_value_date.value
                    WHEN 'double' THEN attribute_value_double.value
                    WHEN 'integer' THEN attribute_value_integer.value
                 END)
             END) IN ( " . collect($value)->map(function($val) {  return "'{$val}'"; })->implode(',') . " )");
        }

        return $query->having(\DB::raw("
            MAX(CASE WHEN attributes.code = '{$attribute}' THEN 
                 (CASE attributes.type
                    WHEN 'varchar' THEN attribute_value_varchar.value
                    WHEN 'textarea' THEN attribute_value_varchar.value
                    WHEN 'dropdown' THEN attribute_value_varchar.value
                    WHEN 'date' THEN attribute_value_date.value
                    WHEN 'double' THEN attribute_value_double.value
                    WHEN 'integer' THEN attribute_value_integer.value
                 END)
             END)
        "), $condition, $value);
    }

    public function scopeAddSlugFilter($query, $slug)
    {
        $query->addAttributeToFilter(Attribute::ATTRIBUTE_SKU_CODE, '=', $slug);
    }

    public function scopeAddAttributeToSelect($query, $attributes = '*')
    {
//        $query->with(['productAttributes' => function ($query) use ($attributes) {
//            return $query->whereIn('code', $attributes);
//        }]);

        if ($attributes == '*') {

            $query->addSelect(\DB::raw("
                 MAX((CASE WHEN attributes.code = '' THEN 
                     (CASE attributes.type
                        WHEN \"varchar\" THEN attribute_value_varchar.value
                        WHEN \"dropdown\" THEN attribute_value_varchar.value
                        WHEN \"date\" THEN attribute_value_date.value
                        WHEN \"double\" THEN attribute_value_double.value
                        WHEN \"integer\" THEN attribute_value_integer.value
                     END)
                 END)) as  
            "));


        }


        foreach ($attributes as $attribute) {
            $query->addSelect(\DB::raw("
                 MAX((CASE WHEN attributes.code = '{$attribute}' THEN 
                     (CASE attributes.type
                        WHEN \"varchar\" THEN attribute_value_varchar.value
                        WHEN \"dropdown\" THEN attribute_value_varchar.value
                        WHEN \"date\" THEN attribute_value_date.value
                        WHEN \"double\" THEN attribute_value_double.value
                        WHEN \"integer\" THEN attribute_value_integer.value
                     END)
                 END)) as {$attribute} 
            "));
        }
    }


}