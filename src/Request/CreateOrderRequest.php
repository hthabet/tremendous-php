<?php
declare(strict_types=1);

namespace Tremendous\Request;

use Tremendous\Reward;

class CreateOrderRequest
{
    /**
     * @var string
     */
    private $paymentFundingSource;

    /**
     * @var array
     */

    private $reward;

    /**
     * @var string
     */
    private $externalId;

    public function __construct(string $paymentFundingSource, array $reward, string $externalId = null)
    {
        $this->paymentFundingSource = $paymentFundingSource;
        $this->reward = $reward;
        $this->externalId = $externalId;
    }

    /**
     * @return string
     */
    public function getExternalId(): string
    {
        return $this->externalId;
    }

    /**
     * @return array
     */
    public function getReward(): array
    {
        return $this->reward;
    }

    /**
     * @return string
     */
    public function getPaymentFundingSource(): string
    {
        return $this->paymentFundingSource;
    }

    public function getPayload(): array
    {
        $payload = [];

        if ($externalId = $this->getExternalId()) {
            $payload['external_id'] = $externalId;
        }
        $payload['payment']['funding_source_id'] = $this->getPaymentFundingSource();
        $payload['reward'] = $this->getReward();

        return $payload;
    }
}
