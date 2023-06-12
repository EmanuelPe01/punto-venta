<?php

$routes = require_once 'routes/api.php';

$requestMethod =  $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '/';

if(array_key_exists($path, $routes)){
    $route = $routes[$path];
    $controllerName = $route['controller'];
    $methodName = $route['method'];

    if(is_array($methodName) && array_key_exists($requestMethod, $methodName)){
        $method = $methodName[$requestMethod];

        if (class_exists($controllerName) && method_exists($controllerName, $method)){
            $controller = new $controllerName();
            $controller->$method();
        } else {
            http_response_code(404);
            echo 'Ruta no encontrada';
        }
    }else{
        http_response_code(405);
        echo 'Método no permitido para esta ruta';
    }
} else {
    http_response_code(404);
    echo 'Ruta no encontrada';
}

