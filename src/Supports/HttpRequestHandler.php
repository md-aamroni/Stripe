<?php

namespace Aamroni\Stripe\Supports;

use Aamroni\Stripe\Exceptions\HttpClientReqException;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Throwable;

readonly class HttpRequestHandler
{
    /**
     * Create a new resolver instance
     * @param  Response|PromiseInterface $response
     * @return void
     */
    public function __construct(private Response|PromiseInterface $response)
    {
        // TODO: Your Code Here...
    }

    /**
     * Get a static resolver instance
     * @param  Response|PromiseInterface $response
     * @return static
     */
    public static function instance(Response|PromiseInterface $response): static
    {
        return new static($response);
    }

    /**
     * Process the HTTP client response
     * @param  string|null      $collect
     * @return Collection|array
     */
    public function process(?string $collect = null): Collection|array
    {
        try {
            return $this->successStateHandler($collect);
        } catch (Throwable $throwable) {
            return $this->onErrorStateHandler($throwable->getMessage());
        }
    }

    /**
     * Handle the HTTP client on successful response
     * @param  string|null            $collect
     * @return Collection|array
     * @throws HttpClientReqException
     */
    private function successStateHandler(?string $collect = null): Collection|array
    {
        if (!$this->response->successful()) {
            throw new HttpClientReqException();
        }
        return json_decode($this->response->collect(key: $collect)->toJson());
    }

    /**
     * Handle the HTTP client on error response
     * @param  array|string $errors
     * @return Collection
     */
    private function onErrorStateHandler(array|string $errors): Collection
    {
        return collect((object) ['error' => $errors])->toBase();
    }
}
