<?php
declare(strict_types=1);

namespace Tremendous;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Stream\Stream;
use Symfony\Component\HttpFoundation\Response;

abstract class Client
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

    protected function sendRequest($request, array $payload): Response
    {
        $request = $this->prepareRequest($request, $payload);

        try {
            $response = $this->processResponse(
                $this->httpClient->send($request)
            );
        } catch (RequestException $exception) {
            $response = $this->processResponse(
                $exception->getResponse()
            );
        }

        return $response;
    }

    /**
     *
     * @param ResponseInterface $response
     *
     * @return Response
     */
    private function processResponse(ResponseInterface $response): Response
    {
        $response = new Response(
            $response->getBody(),
            $response->getStatusCode(),
            $response->getHeaders()
        );

        return $response;
    }

    /**
     * @param RequestInterface $request
     *
     * @return RequestInterface
     */
    protected function prepareRequest(RequestInterface $request, array $payload): RequestInterface
    {
        if ($request->getMethod() === 'GET') {
            $request->setQuery($payload);
        } else {
            $request->setHeader('Content-Type', 'application/json');
            $request->setBody(
                Stream::factory(json_encode($payload))
            );
        }

        return $request;
    }
}
