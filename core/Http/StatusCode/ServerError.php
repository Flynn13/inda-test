<?php

namespace Core\Http\StatusCode;

abstract class ServerError
{
    const INTERNAL_SERVER_ERROR = 500;

    const NOT_IMPLEMENTED = 501;

    const BAD_GATEWAY = 502;

    const SERVICE_UNAVAILABLE = 503;

    const GATEWAY_TIMEOUT = 504;

    const HTTP_VERSION_NOT_SUPPORTED = 505;

    const VARIANT_ALSO_NEGOTIATES = 506;

    const INSUFFICIENT_STORAGE = 507;

    const LOOP_DETECTED = 508;

    const BANDWIDTH_LIMIT_EXCEEDED = 509;

    const NOT_EXTENDED = 510;

    const NETWORK_AUTHENTICATED_REQUIRED = 511;

    const NETWORK_READ_TIMEOUT_ERROR = 598;

    const NETWORK_CONNECT_TIMEOUT_ERROR = 599;
}