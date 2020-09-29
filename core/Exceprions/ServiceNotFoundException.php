<?php

namespace Core\Exceptions;

class ServiceNotFoundException extends \Exception {

    public function __construct($service) {
        parent::__construct('Critical error: the '. $service . ' service was not found');
    }

}