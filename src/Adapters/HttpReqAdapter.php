<?php

namespace Aamroni\Stripe\Adapters;

use Aamroni\Stripe\Interfaces\ClientInterface;

abstract readonly class HttpReqAdapter extends ForFendAdapter implements ClientInterface
{
    /**
     * Define the config
     * @var array|object|mixed
     */
    protected array|object $config;

    /**
     * Create a new Stripe instance
     * @return void
     */
    final public function __construct()
    {
        $this->config = json_decode(json: json_encode(value: config(key: 'payment.stripe')));
    }

    /**
     * Get a static Stripe instance
     * @return static
     */
    public static function instance(): static
    {
        return new static();
    }
}
