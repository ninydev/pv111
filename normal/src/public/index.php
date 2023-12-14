<?php
require_once '../vendor/autoload.php';
/*
// Получаем QUERY_STRING из $_SERVER
$queryString = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';

// Разбиваем QUERY_STRING по символу '/'
$queryStringParts = explode('/', $queryString);

// Получаем название контроллера и метода
$controllerName = isset($queryStringParts[0]) ? ucfirst($queryStringParts[0]) . 'Controller' : 'DefaultController';
$methodName = isset($queryStringParts[1]) ? $queryStringParts[1] : 'index';

*/

// Получаем QUERY_STRING из $_SERVER
$queryString = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
// Разбиваем QUERY_STRING по символу '/'
$queryStringParts = explode('/', $queryString);

var_dump($queryStringParts);

$controllerName = isset($queryStringParts[1]) ? ucfirst($queryStringParts[1]) : 'Page';
$controllerClassName = "\App\Controllers\\". $controllerName . 'Controller';
$methodName = isset($queryStringParts[2]) ? $queryStringParts[2] : 'index';

//$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'Page';
//$controllerClassName = "\App\Controllers\\". $controllerName . 'Controller';
//$methodName = isset($_GET['method']) ? $_GET['method'] : 'index';

echo "<p> Try Find " . $controllerClassName . "::" . $methodName . "</p>";

if (
    !(class_exists($controllerClassName) &&
    method_exists($controllerClassName, $methodName))
){
    $controllerClassName = "\App\Controllers\ErrorController";
    $methodName = 'error404';
}
// Создаем экземпляр класса контроллера
$controllerInstance = new $controllerClassName();
// Вызываем метод
call_user_func([$controllerInstance, $methodName]);
