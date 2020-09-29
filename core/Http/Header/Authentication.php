<?php

namespace Core\Http\Header;

abstract class Authentication
{
    const WWW_AUTHENTICATE = 'WWW-Authenticate';

    const AUTHORIZATION = 'Authorization';

    const PROXY_AUTHENTICATE = 'Proxy-Authenticate';

    const PROXY_AUTHORIZATION = 'Proxy-Authorization';
}