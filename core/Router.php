<?php

namespace Core;

use Core\Http\RequestMethod;

class Router {

    /**
     * @var
     */
    private $method;

    public function __construct(){
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    private $routes = [
        'get'       => [],
        'post'      => [],
        'put'       => [],
        'delete'    => []
    ];

    private $paramTypes = [
        'int' => '[\d]+',
        'string' => '[a-zA-Z]+'
    ];

    public function get($pattern, $handler) {
        if(RequestMethod::isEqueal($this->method, RequestMethod::GET)) {
            $this->routes['get'][$pattern] = $handler;
            return $this;
        }  
    }

    public function post($pattern, $handler) {
        if(RequestMethod::isEqueal($this->method, RequestMethod::POST)) {
            $this->routes['post'][$pattern] = $handler;
            return $this;
        }
    }

    public function put($pattern, $handler) {
        if(RequestMethod::isEqueal($this->method, RequestMethod::PUT)) {
            $this->routes['put'][$pattern] = $handler;
            return $this;
        }
    }

    public function delete($pattern, $handler) {
        if(RequestMethod::isEqueal($this->method, RequestMethod::DELETE)) {
            $this->routes['delete'][$pattern] = $handler;
            return $this;
        }
    }

    public function match(Request $request) {

        $method = strtolower($request->getMethod());
        if ( ! isset($this->routes[$method])) {
            return false;
        }

        $path = $request->getPath();
        //$path = substr($path, 16); // for localhost

        foreach ($this->routes[$method] as $pattern => $handler) {
            $pattern = $this->replace($pattern);
            if (preg_match("%^" . $pattern . "$%", $path, $matches)) {
                return [$handler, $matches];
            }
        }
        return false;
    }

    private function replace($route) {
        $paramTypes = $this->paramTypes;
        $routeWithRegex = preg_replace_callback('%\{{1}(.*?)\}{1}%',function($match) use($paramTypes) {
            $matchArray = explode(':', $match[1]);
            if(isset($matchArray[1]) && array_key_exists($matchArray[1], $paramTypes)) {
                $return = '(?<' . $matchArray[0] . '>' . $paramTypes[$matchArray[1]] .')';
            } else {
                $return = '(?<' . $matchArray[0] . '>[\w]+)';
            }
            return $return;
        }, $route);

        return $routeWithRegex;

    }
}