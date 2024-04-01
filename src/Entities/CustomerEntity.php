<?php

namespace Aamroni\Stripe\Entities;

use Aamroni\Stripe\Interfaces\EntityInterface;

readonly class CustomerEntity implements EntityInterface
{
    /**
     * Create a new customer entity
     * @param  string|null $name
     * @param  string|null $email
     * @param  string|null $mobile
     * @param  string|null $street
     * @param  string|null $city
     * @param  string|null $postal
     * @param  string|null $state
     * @param  string|null $country
     * @return void
     */
    final public function __construct(
        public string|null $name    = null,
        public string|null $email   = null,
        public string|null $mobile  = null,
        public string|null $street  = null,
        public string|null $city    = null,
        public string|null $postal  = null,
        public string|null $state   = null,
        public string|null $country = self::COUNTRY_ISO_CODE,
    ) {
        // TODO: Skip Code Here...
    }

    /**
     * Get a static customer entity
     * @param  string|null $name
     * @param  string|null $email
     * @param  string|null $mobile
     * @param  string|null $street
     * @param  string|null $city
     * @param  string|null $postal
     * @param  string|null $state
     * @param  string|null $country
     * @return static
     */
    public static function instance(
        string|null $name       = null,
        string|null $email      = null,
        string|null $mobile     = null,
        string|null $street     = null,
        string|null $city       = null,
        string|null $postal     = null,
        string|null $state      = null,
        string|null $country    = self::COUNTRY_ISO_CODE,
    ): static {
        return new static($name, $email, $mobile, $street, $city, $postal, $state, $country);
    }

    /**
     * Get the entities resource
     * @return array
     */
    public function resource(): array
    {
        return [
            'name'      => $this->name,
            'email'     => $this->email,
            'phone'     => $this->mobile,
            'address'   => [
                'city'          => $this->city,
                'country'       => $this->country,
                'line1'         => $this->street,
                'postal_code'   => $this->postal,
                'state'         => $this->state
            ]
        ];
    }
}
