<?php

require_once 'MyFirstClass.php';
require_once 'MyMagicClass.php';

$o = new MyMagicClass();
$o->name = "Oleksandr";
$name = $o->name;

//
//$o = new MyFirstClass();
//
//$o->name = "Oleksandr";
//$o->setAge(47);
//
//echo $o;


