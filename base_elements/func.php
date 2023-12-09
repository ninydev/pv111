<?php

/**
 * Эта функция делает что то
 * @param bool $param это параметр
 * @return int|string а это что возвращает функция
 */
function doSomething(bool $param) : int|string
{
    echo __FUNCTION__ . " -  is Work \n";

    if ($param == 10) {
        return "10";
    }
    return 10;
}


$var = doSomething(10);
var_dump($var);
$var = doSomething("100");
var_dump($var);
