<p align="center"><a href="https://qubenext.com" target="_blank"><img src="./logo.svg" width="400" alt="Laravel Logo"></a></p>


### Config Example
Collect your public and secret keys, and configure as necessary in config/payment.php

```php
'stripe' => [
    'public'        => env('STRIPE_PUBLIC_KEY'),
    'secret'        => env('STRIPE_SECRET_KEY'),
    'redirect'      => [
        'success'   => 'http://localhost:8000/stripe/success',
        'cancel'    => 'http://localhost:8000/stripe/cancel'
    ],
    'currency'      => 'USD'
]
```

### Checkout Example
```php
<?php

use Aamroni\Stripe\Entities\CustomerEntity;
use Aamroni\Stripe\Entities\PurchaseEntity;
use Aamroni\Stripe\Facades\Stripe;
use Aamroni\Stripe\StripePaymentManager;

// @step01: Create a customer information
$customer = CustomerEntity::instance(
    name: 'James Wilson',
    email: 'james.wilson@example.com',
    mobile: '+1 562-506-8893',
    street: '2812 Locust Court',
    city: 'Irvine',
    postal: '92614',
    state: 'California',
    country: 'US'
);

// @step02: Create a purchase information
$purchase = PurchaseEntity::instance(
    title: 'FoldSack No. 1 Backpack, Fits 15 Laptops',
    quantity: 1,
    regular: 109.95,
    offered: 99,
    currency: 'USD'
);

// @step03: Process the Stripe checkout
$stripe = Stripe::checkout($customer, $purchase);
// or
$stripe = StripePaymentManager::instance()->checkout($customer, $purchase);

dd($stripe);
```

### Customer Example
```php
<?php

use Aamroni\Stripe\Contracts\CustomerContract;

$instance = CustomerContract::instance();
$response = $instance->create(CustomerEntity: $customer); // Create a customer information
$response = $instance->delete(); // Delete a customer information
$response = $instance->record(); // Fetch all customer information
$response = $instance->record(id: $id); // Fetch a specific customer information

dd($response);
```

### Purchase Example
```php
<?php

use Aamroni\Stripe\Contracts\PurchaseContract;

$instance = PurchaseContract::instance();
$response = $instance->create(PurchaseEntity: $purchase); // Create a purchase information
$response = $instance->record(); // Fetch all purchase information
$response = $instance->record(id: $id); // Fetch a specific purchase information

dd($response);
```
