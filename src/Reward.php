<?php
declare(strict_types=1);

namespace Tremendous;

use Tremendous\Reward\Delivery;
use Tremendous\Reward\Recipient;
use Tremendous\Reward\Value;

class Reward
{
    private $id;

    private $orderId;

    /**
     * @var Value
     */
    private $value;

    /**
     * @var Recipient
     */
    private $recipient;

    /**
     * @var Delivery
     */
    private $delivery;

    public function __construct(string $id, string $orderId, Value $value, Recipient $recipient, Delivery $delivery)
    {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->value = $value;
        $this->recipient = $recipient;
        $this->delivery = $delivery;
    }

    public static function createFromArray($rewardArray)
    {
        $value = Value::createFromArray($rewardArray['value']);
        $recipient = Recipient::createFromArray($rewardArray['recipient']);
        $delivery = Delivery::createFromArray($rewardArray['delivery']);

        return new self($rewardArray['id'], $rewardArray['order_id'], $value, $recipient, $delivery);
    }

    /**
     * @return Delivery
     */
    public function getDelivery(): Delivery
    {
        return $this->delivery;
    }

    /**
     * @return Recipient
     */
    public function getRecipient(): Recipient
    {
        return $this->recipient;
    }

    /**
     * @return Value
     */
    public function getValue(): Value
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
