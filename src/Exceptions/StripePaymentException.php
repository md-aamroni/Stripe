<?php

namespace Aamroni\Stripe\Exceptions;

use Exception;

class StripePaymentException extends Exception
{
    /**
     * The error message
     * @var string
     */
    protected $message = 'An error occurred during stripe payment';
}
