<?php
declare(strict_types=1);

namespace Tremendous;

use Tremendous\Exception\CreateOrderException;
use Tremendous\Request\CreateOrderRequest;
use Tremendous\Response\CreateOrderResponse;

class Tremendous extends Client
{
    public function createOrder(CreateOrderRequest $orderRequest) {

        $uri = "orders";

        $request = $this->httpClient->createRequest('POST', $uri);
        $response = new CreateOrderResponse(
            $this->sendRequest($request, $orderRequest->getPayload())
        );

        if (!$response->getClientResponse()->isSuccessful()) {
            throw new CreateOrderException($response->getErrorMessage());
        }

        return Order::fromCreateArray($response->getOrder());
    }
}
