<?php
declare(strict_types=1);

namespace Tremendous\Reward;

class Delivery
{
    const DELIVERY_METHOD_LINK = 'LINK';

    private $link;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $method;

    /**
     * @var array
     */
    private $meta;


    public function __construct(string $method, string $status, array $meta = [])
    {
        $this->method = $method;
        $this->status = $status;
        $this->meta = $meta;
    }

    public static function createFromArray(array $delivery): self
    {
        $self = new self($delivery['method'], $delivery['status']);

        if ($self->getMethod() === self::DELIVERY_METHOD_LINK && isset($delivery['link'])) {
            $self->setLink($delivery['link']);
        }

        if (isset($delivery['meta'])) {
            $self->setMeta($delivery['meta']);
        }

        return $self;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getMeta(): array
    {
        return $this->meta;
    }

    private function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    private function setMeta($meta)
    {
        $this->meta = $meta;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
