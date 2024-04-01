<?php

namespace Aamroni\Stripe\Interfaces;

use Aamroni\Stripe\Entities\CustomerEntity;
use Aamroni\Stripe\Entities\PurchaseEntity;

interface StripeInterface
{
    /**
     * Process the stripe session checkout
     * @param  CustomerEntity $customer
     * @param  PurchaseEntity $purchase
     * @return mixed
     */
    public function checkout(CustomerEntity $customer, PurchaseEntity $purchase): mixed;
}
