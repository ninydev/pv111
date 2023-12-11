<?php

namespace App\Views\Interfeces;

use App\Collections\ProductCollection;

interface ShowAllViewsInterface
{
    /**
     * Этот метод выводит на экран сразу
     * @return void
     */
    function echoAll(ProductCollection $collection) : void;

    /**
     * Этот метод строит html код - и возвращает его
     * @return string
     */
    function getAllHtml(ProductCollection $collection): string;

}
