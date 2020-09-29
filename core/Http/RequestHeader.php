<?php

namespace Core\Http;


abstract class RequestHeader
{
    // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers#Security

    public static function getHeader($header)
    {
        $headers = getallheaders();
        if(array_key_exists($headers, $header))
        {
            return $headers[$header];
        }

        return null;
    }
}