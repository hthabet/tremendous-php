<?php
declare(strict_types=1);

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Tremendous\Request\CreateOrderRequest;
use Tremendous\Tremendous;

class ClientTest extends TestCase
{
    /**
     * @throws \Tremendous\Exception\CreateOrderException
     * @expectedException Tremendous\Exception\CreateOrderException
     * @expectedExceptionMessage Invalid Access token
     */
    public function testFailure()
    {
        $faker = \Faker\Factory::create();

        $fundingSource = (string) getenv('TREMENDOUS_FUNDING_SOURCE');

        $reward = [
            'campaign_id' => getenv('TREMENDOUS_TEST_CAMPAIGN_IDENTIFIER'),
            'value'       => [
                'denomination'  => 5.00,
                'currency_code' => 'USD'
            ],
            'recipient'   => [
                'name'  => $faker->name(),
                'email' => $faker->safeEmail()
            ],
            'delivery'    => [
                'method' => 'LINK'
            ],
        ];

        $rewardExternalId = \Faker\Provider\Uuid::uuid();

        $invalidToken = 'invalid83924ded57c64add9881e70e35f92a46efbccdd1067a4830b6d6d89b4';

        $config = [
            'base_url' => (string) getenv('TREMENDOUS_ENDPOINT'),
            'defaults' =>
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' .  $invalidToken,
                        'Accept'        => 'application/json',
                        'Content-Type'  => 'application/json'
                    ]
                ]
        ];

        $httpClient = new Client($config);

        $tremendousApi = new Tremendous($httpClient);

        $orderRequest = new CreateOrderRequest($fundingSource, $reward, $rewardExternalId);

        $tremendousApi->createOrder($orderRequest);


    }

    public function testLink()
    {
        $faker = \Faker\Factory::create();

        $fundingSource = (string) getenv('TREMENDOUS_FUNDING_SOURCE');

        $reward = [
            'campaign_id' => getenv('TREMENDOUS_TEST_CAMPAIGN_IDENTIFIER'),
            'value'       => [
                'denomination'  => 5.00,
                'currency_code' => 'USD'
            ],
            'recipient'   => [
                'name'  => $faker->name(),
                'email' => $faker->safeEmail()
            ],
            'delivery'    => [
                'method' => 'LINK'
            ],
        ];

        $rewardExternalId = \Faker\Provider\Uuid::uuid();

        $config = [
            'base_url' => (string) getenv('TREMENDOUS_ENDPOINT'),
            'defaults' =>
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' .  (string) getenv('TREMENDOUS_API_TOKEN'),
                        'Accept'        => 'application/json',
                        'Content-Type'  => 'application/json'
                    ]
                ]
        ];

        $httpClient = new Client($config);

        $tremendousApi = new Tremendous($httpClient);

        $orderRequest = new CreateOrderRequest($fundingSource, $reward, $rewardExternalId);

        $order = $tremendousApi->createOrder($orderRequest);

        $this->assertEquals(5.00, $order->getRewards()[0]->getValue()->getDenomination());
        $this->assertEquals('USD', $order->getRewards()[0]->getValue()->getCurrencyCode());
        $this->assertEquals('SUCCEEDED', $order->getRewards()[0]->getDelivery()->getStatus());

    }


}