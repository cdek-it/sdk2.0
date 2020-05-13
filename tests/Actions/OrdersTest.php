<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\Tests\Actions;

use CdekSDK2\Actions\Orders;
use CdekSDK2\BaseTypes\Order;
use CdekSDK2\Client;
use CdekSDK2\Http\ApiResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\Psr18Client;

class OrdersTest extends TestCase
{

    /**
     * @var Orders
     */
    protected $orders;


    protected function setUp()
    {
        parent::setUp();
        $psr18Client = new Psr18Client();
        $client = new Client($psr18Client);
        $client->setTest(true);
        $this->orders = $client->orders();
        \Doctrine\Common\Annotations\AnnotationReader::addGlobalIgnoredName('phan');

        /** @phan-suppress-next-line PhanDeprecatedFunction */
        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->orders = null;
    }

    public function testAdd()
    {
        $order_number = uniqid('sdk-test', true);
        /** @var Order $order */
        $order = Order::create([
            'number' => $order_number,
            'tariff_code' => '11',
            'comment' => 'test comment',
            'sender' => \CdekSDK2\BaseTypes\Contact::create([
                'name' => 'Иван Васильев',
                'phones' => [
                    \CdekSDK2\BaseTypes\Phone::create(['number' => '+79531234567'])
                ]
            ]),
            'recipient' => \CdekSDK2\BaseTypes\Contact::create([
                'name' => 'Витька Балотоев',
                'email' => 'vasja@cdek.it',
                'phones' => [
                    \CdekSDK2\BaseTypes\Phone::create(['number' => '+79531234567'])
                ]
            ]),
            'delivery_recipient_cost_adv' => [
                \CdekSDK2\BaseTypes\Threshold::create(['sum' => 200, 'threshold' => 1000]),
            ],
            'from_location' => \CdekSDK2\BaseTypes\Location::create(['address' => 'Ленина 23-1', 'code' => 270]),
            'to_location' => \CdekSDK2\BaseTypes\Location::create(['address' => 'Марата, 47-49', 'code' => 137]),
            'packages' => [\CdekSDK2\BaseTypes\Package::create([
                'number' => $order_number,
                'weight' => 1000,
                'length' => 10.8,
                'width' => 11.0,
                'height' => 11.1,
                'comment' => 'comment Package number',
                'items' => [\CdekSDK2\BaseTypes\Item::create([
                    'name' => 'item name',
                    'ware_key' => 'YUQT23DA8734',
                    'payment' => \CdekSDK2\BaseTypes\Money::create([
                        'value' => 0,
                    ]),
                    'cost' => 0,
                    'weight' => 100,
                    'amount' => 10,
                ])]
            ])],
        ]);

        $this->assertTrue($order->validate());

        $response = $this->orders->add($order);
        $this->assertInstanceOf(ApiResponse::class, $response);

        $this->assertTrue($response->isOk());
        $this->assertFalse($response->hasErrors());
    }

    public function testDelete()
    {
        $response = $this->orders->delete('orders');
        $this->assertInstanceOf(ApiResponse::class, $response);
    }

    public function testGet()
    {
        $response = $this->orders->get('orders');
        $this->assertInstanceOf(ApiResponse::class, $response);
    }
}
