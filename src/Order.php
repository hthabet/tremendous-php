<?php
declare(strict_types=1);

namespace Tremendous;

class Order
{
    public $id;

    public $externalId = null;

    public $payment;

    public $rewards = [];

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function fromCreateArray(array $orderArray): self
    {
        $order = new self($orderArray['id']);

        $order->setExternalId($orderArray['external_id']);
        $order->setPayment($orderArray['payment']);
        $order->setRewards($orderArray['rewards']);

        return $order;
    }

    /**
     * @return null
     */
    public function getExternalId()
    {
        return $this->externalId;
    }

    /**
     * @param null $externalId
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;
    }

    /**
     * @return array
     */
    public function getPayment(): array
    {
        return $this->payment;
    }

    /**
     * @param mixed $payment
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
    }

    /**
     * @return array
     */
    public function getRewards(): array
    {
        return $this->rewards;
    }

    /**
     * @param array $rewards
     */
    public function setRewards(array $rewards)
    {
        foreach($rewards as $rewardArray) {
            $reward = Reward::createFromArray($rewardArray);
            $this->rewards[] = $reward;
        }
    }
}
