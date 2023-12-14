<?php

// Подключение автозагрузки классов
use App\Helpers\SendMail;

require_once '../vendor/autoload.php';


$sender = new SendMail();
$sender->send('keeper@ninydev.com', 'Oleksandr Nykytin');


//// Более удобный вариант
//use App\Helpers\Env;
//
//$h = new App\Helpers\MyLibClass();
//$o = new Lib\MyLib\MyClass();
//
//
//$test = Env::get('TEST');
//echo "test = " . $test . "\n";
