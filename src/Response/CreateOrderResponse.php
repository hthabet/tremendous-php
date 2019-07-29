<?php
declare(strict_types=1);

namespace Tremendous\Response;

use Symfony\Component\HttpFoundation\Response;

class CreateOrderResponse
{
    /**
     * @var array
     */
    protected $body;

    /**
     * @var Response
     */
    protected $clientResponse;

    public function __construct(Response $clientResponse)
    {
        $this->clientResponse = $clientResponse;
        $this->body = $this->parseBody();
    }

    public function getErrorMessage(): string
    {
        $errorMessage = 'Create Order failed';
        if ($this->withErrors()) {
            $errors = $this->getErrors();
            $errorMessage = $errors['message'];
        }

        return $errorMessage;
    }

    private function parseBody(): array
    {
        $body = json_decode($this->clientResponse->getContent(), true);
        return $body ?? [];
    }

    private function getErrors(): array
    {
        return $this->body['errors'];
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    public function getOrder(): array
    {
        return $this->body['order'];
    }

    private function withErrors(): bool
    {
        return isset($this->body['errors']);
    }

    public function getClientResponse()
    {
        return $this->clientResponse;
    }
}
