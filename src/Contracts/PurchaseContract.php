<?php

namespace Aamroni\Stripe\Contracts;

use Aamroni\Stripe\Adapters\HttpReqAdapter;
use Aamroni\Stripe\Entities\PurchaseEntity;
use Aamroni\Stripe\Supports\HttpRequestHandler;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

readonly class PurchaseContract extends HttpReqAdapter
{
    /**
     * List all or retrieve a session
     * @param  string|null      $id
     * @return array|Collection
     */
    public function record(?string $id = null): array|Collection
    {
        $setRoute = isset($id) ? sprintf('%s/%s', self::STRIPE_API_SESSIONS, $id) : self::STRIPE_API_SESSIONS;
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . env('STRIPE_SECRET_KEY')])
            ->asForm()
            ->get(url: $setRoute);
        return HttpRequestHandler::instance($response)->process();
    }

    /**
     * Create a session
     * @param  PurchaseEntity   $purchase
     * @param  string           $email
     * @return array|Collection
     */
    public function create(PurchaseEntity $purchase, string $email): array|Collection
    {
        $onHeader = ['Authorization' => 'Bearer ' . env(key: 'STRIPE_SECRET_KEY'), 'Content-Type'  => 'application/x-www-form-urlencoded'];
        $response = Http::withHeaders($onHeader)
            ->asForm()
            ->post(url: self::STRIPE_API_SESSIONS, data: [
                'customer_email'    => $email,
                'line_items'        => [
                    $purchase->resource()
                ],
                'mode'              => 'payment',
                'success_url'       => sprintf('%s?session_id={CHECKOUT_SESSION_ID}', $this->config->redirect->success),
                'cancel_url'        => $this->config->redirect->cancel
            ]);
        return HttpRequestHandler::instance(response: $response)->process();
    }
}
