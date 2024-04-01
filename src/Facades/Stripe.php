<?php

namespace Aamroni\Stripe\Facades;

use Aamroni\Stripe\Entities\CustomerEntity;
use Aamroni\Stripe\Entities\PurchaseEntity;
use Aamroni\Stripe\StripePaymentManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection|string|array checkout(CustomerEntity $customer, PurchaseEntity $purchase)
 */
class Stripe extends Facade
{
    /**
     * Get a static Stripe facade instance
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return StripePaymentManager::class;
    }
}
