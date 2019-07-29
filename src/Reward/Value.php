<?php
declare(strict_types=1);

namespace Tremendous\Reward;

class Value
{
    /**
     * @var float
     */
    private $denomination;

    /**
     * @var string
     */
    private $currencyCode;

    public function __construct(float $denomination, string $currencyCode = 'USD')
    {
        $this->denomination = $denomination;
        $this->currencyCode = $currencyCode;
    }

    public static function createFromArray(array $value): self
    {
        return new self($value['denomination'], $value['currency_code']);
    }

    /**
     * @return float
     */
    public function getDenomination(): float
    {
        return $this->denomination;
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }


}
