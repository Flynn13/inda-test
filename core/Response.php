<?php

namespace Core;

use App\Http\StatusCode;

class Response
{
    private $headers = [];
    private $statusCode;
    private $body;

    public function __construct($statusCode = Http\StatusCode\Success::OK, $headers = []) {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public function setBody($body, $jsonEncode = false) {
        $this->body = $jsonEncode ? json_encode($body) : $body;
    }

    public function setHeaders($headers = []) {
        $this->headers = $headers;
    }

    public function setStatusCode($statusCode = StatusCode\Success::OK) {
        $this->statusCode = $statusCode;
    }

    public function send() {
        http_response_code($this->statusCode);
        foreach($this->headers as $header => $value) {
            header($header . ': ' . $value);
        }

        echo $this->body;
        exit;
    }

    public function redirect($path) {
        header("Location: {$path}");
        exit;
    }
}