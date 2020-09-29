<?php 

namespace Core;


class Application
{
    private $container;

    private $twig;

    public function __construct($container) {
        $this->container = $container;
        $this->twig = $this->container->get('twig');
    }

    public function run() {

        try {
            $this->container->get('dotEnv');
            $this->container->get('dispatcher');
        } catch(\Exception $e) {

            $tpl = $this->twig->load("@templates/errors/500.twig");
            header("HTTP/1.1 500 Internal Server Error");
            echo $tpl->render([]);
            exit;
        }

    }

}