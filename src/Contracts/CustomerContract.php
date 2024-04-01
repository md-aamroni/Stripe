<?php

namespace Aamroni\Stripe\Contracts;

use Aamroni\Stripe\Adapters\HttpReqAdapter;
use Aamroni\Stripe\Entities\CustomerEntity;
use Aamroni\Stripe\Supports\HttpRequestHandler;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

readonly class CustomerContract extends HttpReqAdapter
{
    /**
     * List all or retrieve a customer
     * @param  string|null      $id
     * @return array|Collection
     */
    public function record(?string $id = null): array|Collection
    {
        $setRoute = isset($id) ? sprintf('%s/%s', self::STRIPE_API_CUSTOMER, $id) : self::STRIPE_API_CUSTOMER;
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . env('STRIPE_SECRET_KEY')])
            ->asForm()
            ->get(url: $setRoute);
        return HttpRequestHandler::instance($response)->process();
    }

    /**
     * Create a customer
     * @param  CustomerEntity   $customer
     * @return array|Collection
     */
    public function create(CustomerEntity $customer): array|Collection
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('STRIPE_SECRET_KEY'),
            'Content-Type'  => 'application/x-www-form-urlencoded'
        ])
            ->asForm()
            ->post(url: self::STRIPE_API_CUSTOMER, data: $customer->resource());
        return HttpRequestHandler::instance($response)->process();
    }

    /**
     * Delete a customer
     * @param  string           $id
     * @return array|Collection
     */
    public function delete(string $id): array|Collection
    {
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . env('STRIPE_SECRET_KEY')])
            ->asForm()
            ->delete(url: sprintf('%s/%s', self::STRIPE_API_CUSTOMER, $id));
        return HttpRequestHandler::instance($response)->process();
    }
}
