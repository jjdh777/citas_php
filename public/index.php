<?php
require_once   '../config/config.php';
require_once   '../config/routes.php';
$url = isset($_GET['url']) ? $_GET['url'] : null;

if (isset($routes[$url])) {
    $route = $routes[$url];
    $controllerName = $route[0]; 
    $action = $route[1];
    $controllerFile = '../app/controllers/' . $controllerName . '.php';
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $action)) {
                $url = rtrim($url, '/');
                $url = explode('/', $url);
                $params = array_slice($url, 2);
                $controller->{$action}($params);
            } else {
                require_once   '../app/views/error_404.php';
            }
        } else {
            require_once   '../app/views/error_404.php';
        }
    } else {
        require_once   '../app/views/error_404.php';
    }
} else {
    require_once   '../app/views/error_404.php';
}
