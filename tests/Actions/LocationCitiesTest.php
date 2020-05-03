<?php

declare(strict_types=1);

namespace CdekSDK2\Tests\Actions;

use CdekSDK2\Actions\LocationCities;
use CdekSDK2\Client;
use CdekSDK2\Http\ApiResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\Psr18Client;

class LocationCitiesTest extends TestCase
{
    /**
     * @var LocationCities
     */
    private $cities;

    protected function setUp()
    {
        parent::setUp();
        $client = new Client(new Psr18Client());
        $client->setTest(true);

        $this->cities = $client->cities();
        \Doctrine\Common\Annotations\AnnotationReader::addGlobalIgnoredName('phan');

        /** @phan-suppress-next-line PhanDeprecatedFunction */
        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
    }

    protected function tearDown()
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
        $response = $this->cities->getFiltered(['code' => '22']);
        $this->assertInstanceOf(ApiResponse::class, $response);
    }
}
