<?php

use Controllers\Route;

require_once 'Controllers/HomeController.php';
require_once 'Controllers/AboutController.php';
require_once 'Controllers/ControllerAttribute.php';

$routes = [];

function addRoutesFromController(string $controllerName)
{
    global $routes;

    $reflectionClass = new ReflectionClass($controllerName);

    $controllerAttributes = $reflectionClass->getAttributes('Controllers\Route');

    foreach ($controllerAttributes as $controllerAttribute) {
        $routePath = $controllerAttribute->newInstance()->path;
        $routes[$routePath] = $controllerName;
    }

    $methods = $reflectionClass->getMethods();
    foreach ($methods as $method) {
        $methodAttributes = $method->getAttributes(Route::class);
        foreach ($methodAttributes as $methodAttribute) {
            $routePath = $methodAttribute->newInstance()->path;
            $routes[$routePath] = $controllerName . '@' . $method->getName();
        }
    }
}


addRoutesFromController('Controllers\HomeController');
addRoutesFromController('Controllers\AboutController');

$url = $_SERVER['REQUEST_URI'];

var_dump($routes);

if (array_key_exists($url, $routes)) {
    $controllerAction = explode('@', $routes[$url]);
    $controllerName = $controllerAction[0];
    $methodName = isset($controllerAction[1]) ? $controllerAction[1] : 'index';

    $controller = new $controllerName();

    $controller->{$methodName}();
} else {
    header("HTTP/1.0 404 Not Found");
    echo 'Страница не найдена';
}
