<?php

namespace Core;

use Core\Middleware\Auth;
use Core\Middleware\Guest;
use Core\Middleware\Middleware;

class Router
{
    protected $routes = [];

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'method' => $method,
            'controller' => $controller,
            'middleware' => null
        ];

        return $this;
    }

    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        return $this->add('POST', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }


    public function only($key) {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
        return $this;
    }


    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);

                $controller = $route['controller'];

                if (is_array($controller)) {
                    $class = $controller[0];
                    $method = $controller[1];

                    $instance = new $class();
                    return $instance->$method();
                }

                return require base_path('Http/controllers/' . $controller);
            }
        }

        return $this->abort();
    }

    public function abort($code = 404) {
        http_response_code($code);
        require base_path("views/{$code}.php");
        die();
    }

    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }
}
