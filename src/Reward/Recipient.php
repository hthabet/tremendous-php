<?php
declare(strict_types=1);

namespace Tremendous\Reward;

class Recipient
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public static function createFromArray(array $recipient): self
    {
        return new self($recipient['name'], $recipient['email']);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
