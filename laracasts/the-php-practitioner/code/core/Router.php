<?php

namespace App\Core;

/**
 * Router Class
 */
class Router
{
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static function load($file)
    {
        $router = new self;
        require $file;
        return $router;
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($uri, $method)
    {
        if (array_key_exists($uri, $this->routes[$method])) {
            return $this->callAction(
                ...explode('@', $this->routes[$method][$uri])
            );
        }

        throw new Exception("No route defined to this URI.");
    }

    protected function callAction($controller, $action)
    {
        $controller = "App\Controllers\\{$controller}";
        $controller = new $controller;
        
        if (! method_exists($controller,$action)) {
            throw new Exception("{$action} not found in {$controller} controller");
        }

        return $controller->$action();
    }
}