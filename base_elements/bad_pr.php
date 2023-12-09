<?php


$user_name = "Oleksandr";
$user_email = "keeper@ninydev.com";

$user[0] = 123;
$user['name'] = "Oleksandr";
$user['email'] = "keeper@ninydev.com";
$user["key"] = "value";


$users['Nykytin'] = $user;
$users['Devatorova'] = [
    // ключ => значение
    'name' => 'Svetlana'
];


echo "<pre>";
var_dump($users);
echo "<hr>";

echo json_encode($users);

var_dump( array_keys($users) );

var_dump( array_keys($users['Nykytin']) );

echo "</pre>";



function doUser($u)
{
    // Операция с пользователем
}


// doUser($users);
// До версии 5.3 что бы передвать массивы в методы - необходимо было учитывать
// ссылочные типы (как в классическом С) что из-за низкого уровня (порога вхождения)
// большинство программистов не выполняло
// doUser(&$users);
