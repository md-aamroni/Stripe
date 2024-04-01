<?php

namespace Aamroni\Stripe\Interfaces;

interface EntityInterface
{
    /**
     * Define the base or default currency
     * @var string
     */
    public const DEFAULT_CURRENCY = 'USD';

    /**
     * Define the base or default country
     * @var string
     */
    public const COUNTRY_ISO_CODE = 'US';

    /**
     * Get the entities resource collection
     * @return array
     */
    public function resource(): array;
}
