<?php

namespace App\Logic\Catalog\Product;

use App\Models\Attribute;

trait PriceAbstract
{
    public function hasSpecialPrice()
    {
        return $this->getData(Attribute::ATTRIBUTE_SPECIAL_PRICE_CODE) > 0;
    }

    public function getSpecialPrice()
    {
        return $this->getData(Attribute::ATTRIBUTE_SPECIAL_PRICE_CODE);
    }

    public function getUrl()
    {
        return $this->getData(Attribute::ATTRIBUTE_SKU_CODE);
    }

    public function getPrice()
    {
        return $this->getData(Attribute::ATTRIBUTE_PRICE_CODE);
    }

    public function getFinalPrice()
    {
        return $this->hasSpecialPrice() ? $this->getSpecialPrice() : $this->getPrice();
    }

    public function getFormattedPrice()
    {
        return '<i class="fa fa-inr"></i>' . number_format($this->getPrice());
    }

    public function getFormattedFinalPrice()
    {
        return '<i class="fa fa-inr"></i>' . number_format($this->getFinalPrice());
    }
}