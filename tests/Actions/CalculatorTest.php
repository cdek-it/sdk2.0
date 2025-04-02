<?php

namespace CdekSDK2\Tests\Actions;

use CdekSDK2\Actions\Calculator;
use CdekSDK2\BaseTypes\Location;
use CdekSDK2\BaseTypes\Package;
use CdekSDK2\BaseTypes\Tariff;
use CdekSDK2\BaseTypes\Tarifflist;
use CdekSDK2\Client;
use CdekSDK2\Constraints\Currencies;
use CdekSDK2\Http\ApiResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\Psr18Client;

class CalculatorTest extends TestCase
{
    /**
     * @var Calculator
     */
    protected $calculator;


    protected function setUp(): void
    {
        parent::setUp();
        $psr18Client = new Psr18Client(HttpClient::create([
            'verify_peer' => false,
            'verify_host' => false,
        ]));
        $client = new Client($psr18Client);
        $client->setTest(true);
        $this->calculator = $client->calculator();
        \Doctrine\Common\Annotations\AnnotationReader::addGlobalIgnoredName('phan');

        /** @phan-suppress-next-line PhanDeprecatedFunction */
        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->calculator = null;
    }

    public function testAddTarifflist()
    {
        $tarifflist = Tarifflist::create([]);
        $tarifflist->date = (new \DateTime())->format(\DateTime::ISO8601);
        $tarifflist->type = Tarifflist::TYPE_ECOMMERCE;
        $tarifflist->currency = Currencies::RUBLE;
        $tarifflist->lang = Tarifflist::LANG_RUS;

        $tarifflist->from_location = Location::create([
            'address' => 'Кутузовский проспект 1-1',
            'code' => 137,
            'country_code' => 'RU'
        ]);

        $tarifflist->to_location = Location::create([
            'address' => 'Ленина 23-1',
            'code' => 270,
            'country_code' => 'RU'
        ]);

        $tarifflist->packages = [
            Package::create([
                'weight' => 1000,
                'length' => 30,
                'width' => 20,
                'height' => 10,
            ]),
            Package::create([
                'weight' => 2000,
                'length' => 10,
                'width' => 15,
                'height' => 30,
            ])
        ];

        $this->assertTrue($tarifflist->validate());
        $response = $this->calculator->add($tarifflist);
        $this->assertInstanceOf(ApiResponse::class, $response);
        $this->assertTrue($response->isOk());
        $this->assertFalse($response->hasErrors());
    }

    public function testAddTariff()
    {
        $tariff = Tariff::create([]);
        $tariff->date = (new \DateTime())->format(\DateTime::ISO8601);
        $tariff->type = Tariff::TYPE_ECOMMERCE;
        $tariff->currency = Currencies::RUBLE;
        $tariff->lang = Tariff::LANG_RUS;
        //TODO: Перенести номера тарифов в константы
        $tariff->tariff_code = 139; //Посылка дверь-дверь

        $tariff->from_location = Location::create([
            'address' => 'Кутузовский проспект 1-1',
            'code' => 137,
            'country_code' => 'RU'
        ]);

        $tariff->to_location = Location::create([
            'address' => 'Ленина 23-1',
            'code' => 270,
            'country_code' => 'RU'
        ]);

        $tariff->packages = [
            Package::create([
                'weight' => 1000,
                'length' => 30,
                'width' => 20,
                'height' => 10,
            ]),
            Package::create([
                'weight' => 2000,
                'length' => 10,
                'width' => 15,
                'height' => 30,
            ])
        ];

        $this->assertTrue($tariff->validate());
        $response = $this->calculator->add($tariff);
        $this->assertInstanceOf(ApiResponse::class, $response);
        $this->assertTrue($response->isOk());
        $this->assertFalse($response->hasErrors());
    }
}
