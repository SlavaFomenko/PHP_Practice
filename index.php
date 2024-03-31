<?php

include('Controllers/HomeController.php');
include('Controllers/AboutController.php');


$routes = [
    '/'           => 'HomeController@index',
    '/main'       => 'HomeController@main',
    '/etc'        => 'HomeController@etc',
    '/about'      => 'AboutController@index',
    '/about/main' => 'AboutController@main',
    '/about/etc'  => 'AboutController@etc'
];

$url = $_SERVER['REQUEST_URI'];

if (array_key_exists($url, $routes)) {

    $controllerAction = explode('@', $routes[$url]);


    $controllerName = 'Controllers\\' . $controllerAction[0];
    $methodName = $controllerAction[1];

    $controller = new $controllerName();

    $controller->{$methodName}();
} else {
    header("HTTP/1.0 404 Not Found");
    echo 'Страница не найдена';
}
