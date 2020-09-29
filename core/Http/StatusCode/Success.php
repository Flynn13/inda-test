<?php

namespace Core\Http\StatusCode;

abstract class Success
{
    const OK = 200;

    const CREATED = 201;

    const ACCEPTED = 202;

    const NON_AUTHORITATIVE_INFORMATION = 203;

    const NO_CONTENT = 204;

    const RESET_CONTENT = 205;

    const PARTIAL_CONTENT = 206;

    const MULTI_STATUS = 207;

    const ALREADY_REPORTED = 208;

    const IM_USED = 226;
}