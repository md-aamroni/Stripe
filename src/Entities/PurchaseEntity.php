<?php

namespace Aamroni\Stripe\Entities;

use Aamroni\Stripe\Interfaces\EntityInterface;

readonly class PurchaseEntity implements EntityInterface
{
    /**
     * Create a new purchase entity
     * @param  string|null     $title
     * @param  string|null     $detail
     * @param  string|null     $image
     * @param  int|string|null $quantity
     * @param  int|float|null  $regular
     * @param  int|float|null  $offered
     * @param  string|null     $currency
     * @return void
     */
    final public function __construct(
        public string|null     $title       = null,
        public string|null     $detail      = null,
        public string|null     $image       = null,
        public int|string|null $quantity    = null,
        public int|float|null  $regular     = null,
        public int|float|null  $offered     = null,
        public string|null     $currency    = self::DEFAULT_CURRENCY,
    ) {
        // TODO: Skip Code Here...
    }

    /**
     * Get a static purchase entity
     * @param  string|null     $title
     * @param  string|null     $detail
     * @param  string|null     $image
     * @param  int|string|null $quantity
     * @param  int|float|null  $regular
     * @param  int|float|null  $offered
     * @param  string|null     $currency
     * @return static
     */
    public static function instance(
        string|null     $title      = null,
        string|null     $detail     = null,
        string|null     $image      = null,
        int|string|null $quantity   = null,
        int|float|null  $regular    = null,
        int|float|null  $offered    = null,
        string|null     $currency   = self::DEFAULT_CURRENCY
    ): static {
        return new static($title, $detail, $image, $quantity, $regular, $offered, $currency);
    }

    /**
     * Get the entities resource
     * @return array
     */
    public function resource(): array
    {
        return [
            'quantity'      => $this->quantity,
            'price_data'    => [
                'currency'      => $this->currency ?? config(key: 'payment.stripe.currency', default: self::DEFAULT_CURRENCY),
                'product_data'  => [
                    'name'          => $this->title,
                    'description'   => $this->detail
                ],
                'unit_amount'   => 100 * ($this->regular - $this->offered)
            ]
        ];
    }
}
