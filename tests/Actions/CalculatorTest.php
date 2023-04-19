<?php

namespace CdekSDK2\Tests\Actions;

use CdekSDK2\Actions\Calculator;
use CdekSDK2\BaseTypes\Location;
use CdekSDK2\BaseTypes\Package;
use CdekSDK2\BaseTypes\Tarifflist;
use CdekSDK2\Client;
use CdekSDK2\Constraints\Currencies;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\Psr18Client;

class CalculatorTest extends TestCase
{
    /**
     * @var Calculator
     */
    protected $calculator;


    protected function setUp()
    {
        parent::setUp();
        $psr18Client = new Psr18Client();
        $client = new Client($psr18Client);
        $client->setTest(true);
        $this->calculator = $client->calculator();
        \Doctrine\Common\Annotations\AnnotationReader::addGlobalIgnoredName('phan');

        /** @phan-suppress-next-line PhanDeprecatedFunction */
        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->calculator = null;
    }

    public function testAdd()
    {
        $tarifflist = Tarifflist::create([]);
        $tarifflist->date = (new \DateTime())->format(\DateTime::ISO8601);
        $tarifflist->type = Tarifflist::TYPE_ECOMMERCE;
        $tarifflist->currecy = Currencies::RUBLE;
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
        $this->assertTrue($response->isOk());
        $this->assertFalse($response->hasErrors());
    }
}
