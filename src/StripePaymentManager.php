<?php

namespace Aamroni\Stripe;

use Aamroni\Stripe\Adapters\PaymentAdapter;
use Aamroni\Stripe\Contracts\CustomerContract;
use Aamroni\Stripe\Contracts\PurchaseContract;
use Aamroni\Stripe\Entities\CustomerEntity;
use Aamroni\Stripe\Entities\PurchaseEntity;
use Aamroni\Stripe\Exceptions\StripePaymentException;
use Illuminate\Support\Collection;
use Throwable;

readonly class StripePaymentManager extends PaymentAdapter
{
    /**
     * Process the stripe session checkout
     * @param  CustomerEntity          $customer
     * @param  PurchaseEntity          $purchase
     * @return Collection|string|array
     */
    public function checkout(CustomerEntity $customer, PurchaseEntity $purchase): Collection|string|array
    {
        try {
            $instance = CustomerContract::instance()->create(customer: $customer);
            if (empty($instance) && (!is_array($instance) || !is_object($instance))) {
                throw new StripePaymentException();
            }
            return PurchaseContract::instance()->create(purchase: $purchase, email: $customer->email);
        } catch (Throwable $exception) {
            return $exception->getMessage();
        }
    }
}
