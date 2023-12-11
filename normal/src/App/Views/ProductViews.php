<?php

namespace App\Views;

use App\Collections\ProductCollection;
use App\Views\Interfeces\ShowAllViewsInterface;

class ProductViews implements ShowAllViewsInterface
{

    function echoAll(ProductCollection $collection): void
    {
        echo "<ul>";
        foreach ($collection->getAll() as $product) {
            echo "<li> $product </li>";
        }
        echo "</ul>";
    }

    function getAllHtml(ProductCollection $collection): string
    {
        // первый вариант построить ответ
//        $resultString = "<ul>";
//        foreach ($collection->getAll() as $product) {
//            $resultString.= "<li> $product </li>";
//        }
//        $resultString.= "</ul>";
//        return $resultString;

        ob_start();
        $this->echoAll($collection);
        return ob_get_clean();
    }
}
