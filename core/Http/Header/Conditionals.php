<?php

namespace Core\Http\Header;

abstract class Conditionals
{
    const LAST_MODIFIED = 'Last-Modified';

    const ETAG = 'ETag';

    const IF_MATCH = 'If-Match';

    const IF_NONE_MATCH = 'If-None-Match';

    const IF_MODIFIED_SINCE = 'If-Modified-Since';

    const IF_UNMODIFIED_SINCE = 'If-Unmodified-Since';

    const VARY = 'Vary';
}