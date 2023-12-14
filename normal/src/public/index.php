<?php
require_once '../vendor/autoload.php';

$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'Page';
$controllerClassName = "\App\Controllers\\". $controllerName . 'Controller';

$methodName = isset($_GET['method']) ? $_GET['method'] : 'index';

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
