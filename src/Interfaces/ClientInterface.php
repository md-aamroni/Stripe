<?php

namespace Aamroni\Stripe\Interfaces;

interface ClientInterface
{
    /**
     * Define the Stripe customer endpoint
     * @var string
     */
    public const STRIPE_API_CUSTOMER = 'https://api.stripe.com/v1/customers';

    /**
     * Define the Stripe sessions endpoint
     * @var string
     */
    public const STRIPE_API_SESSIONS = 'https://api.stripe.com/v1/checkout/sessions';
}
