<?php

namespace App\Collections;

use App\Collections\Interfaces\ProductCollectionInterface;
use App\Collections\Interfaces\SeedInterface;
use App\Models\ProductModel;

class ProductCollection implements ProductCollectionInterface, SeedInterface
{
    public function __construct()
    {
        $this->seed();
    }

    private $data = [];

    function addProduct(ProductModel $product): void
    {
        $this->data[] = $product;
    }

    function getAll(): array
    {
        return $this->data;
    }

    function searchByName(string $name): array
    {

        $foundProducts = [];

        foreach ($this->data as $product) {
            if ($product instanceof ProductModel && $product->getName() === $name) {
                $foundProducts[] = $product;
            }
        }

        return $foundProducts;
    }

    /**
     * Предварительное (первоначальное) заполнение коллекции
     * @return void
     */
    function seed()
    {
        $this->data[] = new ProductModel('EcoFlow Delta 2', 59000);
        $this->data[] = new ProductModel('Samsung S23', 39000);
        $this->data[] = new ProductModel('Nokia 3033', 100);
    }
}
