<?php

namespace App\Requests;

use App\Models\ProductModel;

class ProductCreateRequest
{

    /**
     * @return ProductModel|null
     */
    static function getProduct()
    {
        if(isset($_REQUEST['name']) && isset($_REQUEST['price'])) {
            return new ProductModel($_REQUEST['name'], $_REQUEST['price']);
        }
        return null;
    }
}
