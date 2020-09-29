<?php


use Core\ServiceContainer;

return [

    'dotEnv' => function () {
        $dotenv = \Dotenv\Dotenv::createImmutable(PROJECT_ROOT);
        $dotenv->load();
    },

    'twigLoader' => function () {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../resources/views');
        $loader->addPath(__DIR__ .'/../resources/views', 'templates');
        return $loader;
    },

    'twig' => function (ServiceContainer $container) {
        $twig = new \Twig\Environment($container->get('twigLoader'), [
            'debug' => true,
            'autoescape' => false
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());

        return $twig;
    },

    'database' => function() {
        $database = new \Core\Database();
        return $database->db;
    },

    'dispatcher' => function (ServiceContainer $container) {

        $dispatcher = new \Core\Dispatcher($container->get('router'), $container->get('twigLoader'), $container->get('twig'));
        $dispatcher->handle($container->get('request'));
        return $dispatcher;
    },

    'router' => function () {
        $router = new \Core\Router();
        require_once __DIR__ . '/../routes/routes.php';
        return $router;
    },

    'request' => function () {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        return new \Core\Request($requestMethod, $_SERVER['REQUEST_URI']);
    },


];