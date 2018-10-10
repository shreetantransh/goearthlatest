<?php

namespace App\Models;

use App\Logic\Catalog\Product\PriceAbstract;
use App\Logic\Catalog\Product\ProductAbstract;

use App\Logic\Catalog\Product\StockAbstract;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use ProductAbstract, PriceAbstract, StockAbstract;

    const PRODUCT_TYPE_SIMPLE = 'product_type_simple';
    const PRODUCT_TYPE_CONFIGURABLE = 'product_type_configurable';

    protected $fillable = ['attribute_set_id', 'type'];

    public $attributeValues = [];
    protected $attributeData = null;


    public function save(array $options = [])
    {
        self::saveAttributes($this, $this->attributeValues);
        return parent::save($options);
    }

    public function scopeFrontend($query)
    {
        $query->addAttributeToFilter('status', '=', 'Enabled');
    }

    public function related()
    {
        return $this->belongsToMany(Product::class, 'related_products', 'product_id', 'related_product_id');
    }

    public function upsells()
    {
        return $this->belongsToMany(Product::class, 'product_up_sells', 'product_id', 'related_product_id');
    }

    public function crossSell()
    {
        return $this->belongsToMany(Product::class, 'product_cross_sells', 'product_id', 'related_product_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes')
            ->select(\DB::raw('attributes.*,
                 (CASE attributes.type
                    WHEN "varchar" THEN attribute_value_varchar.value
                    WHEN "dropdown" THEN attribute_value_varchar.value
                    WHEN "textarea" THEN attribute_value_varchar.value
                    WHEN "date" THEN attribute_value_date.value
                    WHEN "double" THEN attribute_value_double.value
                    WHEN "integer" THEN attribute_value_integer.value
                END) as attribute_value
            '))
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
            })
            ->withTimestamps();
    }

    public function attributeSet()
    {
        return $this->belongsTo(AttributeSet::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getBaseImage($size = 'thumbnail')
    {
        if ($this->images()->count()) {
            $image = $this->images()->first();
            return $image->getUrl($size);
        }

        return '';
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function stock()
    {
        return $this->hasOne(ProductStock::class);
    }

    public function inStock()
    {
        return (boolean)optional($this->stock)->quantity;
    }

    public function scopeHasStock($query)
    {
        return $query->leftJoin('product_stocks', 'product_stocks.product_id', '=', 'products.id')->where('product_stocks.quantity', '>', 0);
    }
}
