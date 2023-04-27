<?php

declare(strict_types=1);

namespace CdekSDK2\Tests\Actions;

use CdekSDK2\Actions\LocationCities;
use CdekSDK2\BaseTypes\Location;
use CdekSDK2\Client;
use CdekSDK2\Dto\City;
use CdekSDK2\Dto\CityList;
use CdekSDK2\Http\ApiResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\Psr18Client;

class LocationCitiesTest extends TestCase
{
    /**
     * @var LocationCities
     */
    private $cities;

    protected function setUp(): void
    {
        parent::setUp();
        $psr18Client = new Psr18Client(HttpClient::create([
            'verify_peer' => false,
            'verify_host' => false,
        ]));
        $client = new Client($psr18Client);
        $client->setTest(true);

        $this->cities = $client->cities();
        \Doctrine\Common\Annotations\AnnotationReader::addGlobalIgnoredName('phan');

        /** @phan-suppress-next-line PhanDeprecatedFunction */
        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->cities = null;
    }

    public function testGet()
    {
        $response = $this->cities->get();
        $this->assertInstanceOf(ApiResponse::class, $response);
    }

    public function testGetFiltered()
    {
        $psr18Client = new Psr18Client(HttpClient::create([
            'verify_peer' => false,
            'verify_host' => false,
        ]));
        $client = new Client($psr18Client);
        $client->setTest(true);

        $response = $client->cities()->getFiltered(['code' => '22']);
        $this->assertInstanceOf(ApiResponse::class, $response);

        /* @var CityList $cities */
        $cities = $client->formatResponseList($response, CityList::class);
        $this->assertInstanceOf(CityList::class, $cities);

        foreach ($cities->items as $city) {
            $this->assertInstanceOf(City::class, $city);
        }
    }
}
