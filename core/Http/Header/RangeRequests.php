<?php

namespace Core\Http\Header;

abstract class RangeRequests
{
    const ACCEPT_RANGES = 'Accept-Ranges';

    const RANGE = 'Range';

    const IF_RANGE = 'If-Range';

    const CONTENT_RANGE = 'Content-Range';
}