<?php

namespace Core\Exceptions;

class ObjectNotFoundException extends \Exception
{
    public function __construct($objectName) {
        parent::__construct('Critical error: the '. $objectName . ' is not found!');
    }
}