<?php

namespace App\Controllers;

abstract class Controller {

    protected $loader;

    protected $twig;

    public function __construct($loader, $twig) {
        $this->loader = $loader;
        $this->twig   = $twig;
    }
}