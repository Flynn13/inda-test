<?php

namespace Core\Http\Header;

abstract class Caching
{
    const AGE = 'Age';

    const CACHE_CONTROL = 'Cache-Control';

    const CLEAR_SITE_DATA = 'Clear-Site-Data';

    const EXPIRES = 'Expires';

    const PRAGMA = 'Pragma';

    const WARNING = 'Warning';
}