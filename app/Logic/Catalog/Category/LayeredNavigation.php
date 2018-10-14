<?php
/**
 * Created by PhpStorm.
 * Customer: bay
 * Date: 3/8/2018
 * Time: 3:55 PM
 */

namespace App\Logic\Catalog\Category;

use App\Models\Category;
use App\Models\Attribute;

class LayeredNavigation
{
    protected $category;
    protected $attributesCollection;

    public function init(Category $category)
    {
        $this->category = $category;
    }

    public function getSortableAttributes()
    {
        return $this->prepareAttributeCollection()->where('used_in_product_sorting', true)
            ->orderBy('attributes.sequence', 'ASC')
            ->pluck('label', 'attributes.id')
            ->prepend('Select', '');
    }

    public function getFiltersHtml()
    {
        $filterableAttributes = $this->getFilterableAttributes();

        $outputHtml = '';

        if ($filterableAttributes->count() > 0) {
            foreach ($filterableAttributes->get() as $attribute) {
                switch ($attribute->type) {
                    case Attribute::TYPE_DROPDOWN:
                    case Attribute::TYPE_MULTISELECT:
                    case Attribute::TYPE_CHECKBOX: {

                        $options = $attribute->options()->pluck('option_value', 'option_value');

                        $outputHtml .= view('catalog.category.layered.checkbox', compact('attribute', 'options'));
                        break;
                    }

                    case Attribute::TYPE_DOUBLE: {
                        if ($attribute->code == 'price') {
                            $outputHtml .= view('catalog.category.layered.price', compact('attribute'));
                            break;
                        }
                    }

                    default:
                }
            }
        }

        return $outputHtml;
    }

    public function getFilterableAttributes()
    {
        return $this->prepareAttributeCollection()
            ->where('used_in_product_listing', true)
            ->groupBy('attributes.id');
    }

    protected function prepareAttributeCollection()
    {
        return Attribute::select('attributes.*')
            ->join('product_attributes', 'product_attributes.attribute_id', '=', 'attributes.id')
            ->join('products', 'products.id', '=', 'product_attributes.product_id')
            ->join('category_product', 'category_product.product_id', '=', 'products.id')
            ->where('category_product.category_id', $this->category->id);
    }
}

