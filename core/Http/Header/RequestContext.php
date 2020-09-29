<?php

namespace Core\Http\Header;

abstract class RequestContext
{
    const FROM = 'From';

    const HOST = 'Host';

    const REFERRER = 'Referrer';

    const REFERRER_POLICY = 'Referrer-Policy';

    const USER_AGENT = 'User-Agent';
}