<?php

namespace Aamroni\Stripe\Adapters;

use Aamroni\Stripe\Interfaces\StripeInterface;

abstract readonly class PaymentAdapter extends ForFendAdapter implements StripeInterface
{
    /**
     * Create a new payment instance
     * @return void
     */
    final public function __construct()
    {
        // TODO: Your Code Here...
    }

    /**
     * Get a static payment instance
     * @return static
     */
    public static function instance(): static
    {
        return new static();
    }
}
