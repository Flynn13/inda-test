<?php

namespace Core;

class ServiceContainer
{
    private $services;

    public function __construct(array $services = []) {
        $this->services = $services;
    }

    public function put($key, $value) {
        $this->services[$key] = $value;
    }

    public function get($key) {
        if(array_key_exists($key, $this->services)) {
            if(is_callable($this->services[$key])) {
                $factory = $this->services[$key];
                $this->services[$key] = $factory($this);
            }
        } else {
            throw new \Core\Exceptions\ServiceNotFoundException($key);
        }
        return $this->services[$key];
    }
}