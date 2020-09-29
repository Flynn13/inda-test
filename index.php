<?php

declare(strict_types=1);
define('PROJECT_ROOT', __DIR__);

require_once 'vendor/autoload.php';

(new Core\Application(new \Core\ServiceContainer(include 'config/services.php')))->run();