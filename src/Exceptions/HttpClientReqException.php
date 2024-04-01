<?php

namespace Aamroni\Stripe\Exceptions;

use Exception;

class HttpClientReqException extends Exception
{
    /**
     * The error message
     * @var string
     */
    protected $message = 'An error occurred during HTTP request';
}
