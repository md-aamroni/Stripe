<?php

namespace Aamroni\Stripe\Providers;

use Aamroni\Stripe\Facades\Stripe;
use Aamroni\Stripe\StripePaymentManager;
use Illuminate\Support\ServiceProvider;

class StripeServiceProvider extends ServiceProvider
{
    /**
     * Register stripe payment services
     * @return void
     */
    public function register(): void
    {
        // @todo: bind the base class
        $this->app->bind(abstract: Stripe::class, concrete: StripePaymentManager::class);

        // @todo: merge the config file
        $this->mergeConfigFrom(path: __DIR__ . '/../../config/payment.php', key: 'payment');
    }

    /**
     * Bootstrap stripe payment services
     * @return void
     */
    public function boot(): void
    {
        // @todo: publish the config file
        $this->publishes(paths: [
            __DIR__ . '/../../config/payment.php' => config_path(path: 'payment.php'),
        ], groups: 'aamroni-payment');
    }
}
