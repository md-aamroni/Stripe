<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Stripe Payment Service Config
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache store that will be used by the
    | framework. This connection is utilized if another isn't explicitly
    | specified when running a cache operation inside the application.
    |
    */
    'stripe' => [
        'public'        => env('STRIPE_PUBLIC_KEY'),
        'secret'        => env('STRIPE_SECRET_KEY'),
        'redirect'      => [
            'success'   => sprintf('%s/stripe/success', env('APP_URL')),
            'cancel'    => sprintf('%s/stripe/cancel', env('APP_URL')),
        ],
        'currency'      => 'USD'
    ],
];
