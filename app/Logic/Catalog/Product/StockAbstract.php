<?php
/**
 * Created by PhpStorm.
 * Customer: bay
 * Date: 4/25/2018
 * Time: 3:37 PM
 */

namespace App\Logic\Catalog\Product;


trait StockAbstract
{
    public function isInStock()
    {
        return true;
    }

    public function hasStock($quantity = 1)
    {
        return true;
    }

    public function hasStockForBuy($quantity = 1)
    {
        return true;
    }

    public function getStock()
    {

    }

    public function getStockQty()
    {

    }
}