<?php

namespace App\Collections\Interfaces;

use App\Models\ProductModel;

interface ProductCollectionInterface
{

    function addProduct(ProductModel $product) : void;

    function getAll() : array;

    function searchByName(string $name) : array;

}
