<?php
namespace Api;

use Api\Controllers\HomeController;
use Api\Controllers\UsersController;

class Application {

    public $routes = [
        '/' => [
            'controller' => HomeController::class,
            'action' => 'index',
            'method' => 'GET'
        ],
        '/users' => [
            'controller' => UsersController::class,
            'action' => 'index',
            'method' => 'GET'

        ],
        '/users/{id}' => [
            'controller' => UsersController::class,
            'action' => 'show',
            'method' => 'GET'
        ],
        '/users/{id}/edit' => [
            'controller' => UsersController::class,
            'action' => 'edit',
            'method' => 'POST'
        ],


    ];

    public function run() {
       
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];


        $route = $this->findRoute($uri);

        //call_user_func([$route['controller'], $route['action']]);
        
        if ($route) {
            $controller = $route['controller'];
            $action = $route['action'];
            
            if ($route['method'] == $method) {

                call_user_func_array([new $controller, $action], $route['params']);

                // same as above
                //$controller = new $controller();
                //$controller->$action(...$route['params']);
            } else {
                header('HTTP/1.1 405 Method not allowed');
                echo 'Method not allowed';
            }
            
        } else {
            header('HTTP/1.0 404 Not Found');
            echo 'Route not found';
        }

    }

    public function findRoute($uri) {
        foreach ($this->routes as $route => $params) {

            // replace {id} with ([0-9]+)
            $route = preg_replace('/\{([a-z]+)\}/', '([a-z0-9]+)', $route);

            if (preg_match('#^' . $route . '$#i', $uri, $matches)) {
                array_shift($matches);
                $params['params'] = $matches;
                return $params;
            }


        }
        return false;
    }

}