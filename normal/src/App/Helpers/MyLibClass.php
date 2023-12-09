<?php

// Папочки - в которых лежит файл с классом
namespace App\Helpers;

// Имя класса совпадает с именем файла
class MyLibClass
{
    public function __construct()
    {
        echo  __CLASS__ . " create \n";
    }

}
