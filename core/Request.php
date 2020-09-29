<?php

namespace Core;

use Core\Exceptions\InvalidRequestParameterException;
use Core\Exceptions\ObjectNotFoundException;
use \Core\Http\RequestMethod;

class Request {

    private $method;

    private $path;

	private $body;

    public function __construct($method, $path) {
        $this->method = $method;
        $this->path = explode('?', $path)[0];
		$this->setBody();
    }

    public function getMethod() {
        return $this->method;
    }

    public function getPath() {
        return $this->path;
    }

	public function setBody() {
		$this->body = null;
		if (RequestMethod::isEqueal($this->method, RequestMethod::GET)) {
			return false;
		}

		$this->body = json_decode(file_get_contents('php://input'));

		if($this->body != null || $this->body != '') {
			return false;
		}

		$this->body = isset($_POST) ? (object)$_POST : null;
		return true;
	}

	public function getBody() {
		return $this->body;
	}

	public function getParsedBody($objectName) {
		if (!class_exists($objectName))
		{
			throw new ObjectNotFoundException($objectName);
		}

		$paredClass = new $objectName();
		foreach($paredClass as $key => $value)
		{
			if(!property_exists($this->body, $key))
			{
				throw new \HttpRequestException();
			}

			$paredClass->$key = $this->body->$key;
		}

		return $paredClass;
	}
}
