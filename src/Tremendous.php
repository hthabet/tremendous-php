<?php
declare(strict_types=1);

namespace Tremendous;

use GuzzleHttp\ClientInterface;
use Tremendous\Exception\CreateOrderException;
use Tremendous\Request\CreateOrderRequest;

class Tremendous
{
    /**
     * @var ClientInterface Http Client
     */
    protected $httpClient;

    /**
     * Client constructor.
     *
     * @param ClientInterface $httpClient
     *
     */
    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    protected function decode(string $string): array
    {
        $array = \json_decode($string, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($array)) {
            throw new \InvalidArgumentException('Invalid json data');
        }

        return $array;
    }

    public function createOrder(CreateOrderRequest $orderRequest)
    {
        $uri = "orders";

        try {

            $request = $this->httpClient->request('POST', $uri, [
                'body'    => json_encode($orderRequest->getPayload()),
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);

            $data = $this->decode((string)$request->getBody());

            return Order::fromCreateArray($data['order']);

        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            throw new CreateOrderException($exception->getMessage(), $exception);
        }
    }
}
