<?php

namespace Core;
use Core\Exceptions\TemplateNotFoundException;
use Core\Interfaces\IDispatcher;

class Dispatcher implements IDispatcher {

    private $router, $twig, $loader;

    function __construct(Router $router, $loader, $twig) {
        
        $this->loader = $loader;
        $this->twig = $twig;
        $this->router = $router;
    }

    function handle(Request $request) {
        $handler = $this->router->match($request);

        $params = isset($handler[1]) ? $handler[1] : null;

        if ( ! $handler) {
            $this->notFound();
            return;
        }

        if(is_callable($handler[0])) {
            $handler[0]($params, $request);
        } else {
            $handlerArray = explode('@', $handler[0]);
            $class = $handlerArray[0];
            $method = $handlerArray[1];
            $controller = "App\\Controllers\\" . $class;
            $ctrl = new $controller($this->loader, $this->twig);

            $cleanedParams = [];
            foreach($params as $key => $param) {
                if(gettype($key) == 'string') {
                    $cleanedParams[$key] = $param;
                }
            }

            $request->paramBag = $cleanedParams;
            try {
                $ctrl->$method($cleanedParams, $request);
            } catch(TemplateNotFoundException $e) {
                die($e->getMessage());
            }

           
        }
        
    }

    public function notFound() {
        $tpl = $this->twig->load("@templates/errors/404.twig");
        header("HTTP/1.1 404 Not Found");
        echo $tpl->render([]);
    }

}