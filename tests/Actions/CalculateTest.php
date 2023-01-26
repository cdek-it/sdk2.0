<?php

namespace CdekSDK2\Tests\Actions;

use CdekSDK2\BaseTypes\Item;
use CdekSDK2\BaseTypes\Location;
use CdekSDK2\BaseTypes\Money;
use CdekSDK2\BaseTypes\Package;
use CdekSDK2\BaseTypes\TariffByCode;
use CdekSDK2\Client;
use CdekSDK2\Http\ApiResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\Psr18Client;

class CalculateTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $psr18Client = new Psr18Client();
        $client = new Client($psr18Client);
        $client->setTest(true);
        $this->calculate = $client->calculate();
    }
    public function testCalculateByTariffCode()
    {
        $order_number = uniqid('sdk-test', true);
        $tariffByCode = TariffByCode::create([
            'type' => 1,
            'tariff_code' => 136,
            'from_location' => Location::create(['address' => 'Ленина 23-1', 'code' => 270]),
            'to_location' => Location::create(['address' => 'Марата, 47-49', 'code' => 137]),
            'weight' => 1000,
            'packages' => [Package::create([
                'number' => $order_number,
                'weight' => 1000,
                'length' => 10.8,
                'width' => 11.0,
                'height' => 11.1,
                'comment' => 'comment Package number',
                'items' => [Item::create([
                    'name' => 'item name',
                    'ware_key' => 'YUQT23DA8734',
                    'payment' => Money::create([
                        'value' => 0,
                    ]),
                    'cost' => 0,
                    'weight' => 100,
                    'amount' => 10,
                ])]
            ])],
        ]);
        $this->assertTrue($tariffByCode->validate());
        $response = $this->calculate->calculateByTariffCode($tariffByCode);
        $this->assertInstanceOf(ApiResponse::class, $response);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->barcodes = null;
    }
}
