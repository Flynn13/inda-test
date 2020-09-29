<?php
/**
 * Created by PhpStorm.
 * User: Ádám
 * Date: 2020.03.29.
 * Time: 0:59
 */

namespace Core\Exceptions;

class TemplateNotFoundException extends \Exception {
    public function __construct($template) {
        parent::__construct($template);
    }
}