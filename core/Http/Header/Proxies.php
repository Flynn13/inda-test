<?php

namespace Core\Http\Header;

abstract class Proxies
{
    const FORWARDED = 'Forwarded';

    const X_FORWARDED_FOR = 'X-Forwarded-For';

    const X_FORWARDED_HOST = 'X-Forwarded-Host';

    const X_FORWARDED_PROTO = 'X-Forwarded-Proto';

    const VIA = 'Via';
}