<?php

declare(strict_types=1);

namespace CdekSDK2\Tests\Actions;

use CdekSDK2\Actions\LocationRegions;
use CdekSDK2\Client;
use CdekSDK2\Http\ApiResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\Psr18Client;

class LocationRegionsTest extends TestCase
{
    /**
     * @var LocationRegions
     */
    private $regions;

    protected function setUp()
    {
        parent::setUp();
        $client = new Client(new Psr18Client());
        $client->setTest(true);

        $this->regions = $client->regions();
        \Doctrine\Common\Annotations\AnnotationReader::addGlobalIgnoredName('phan');

        /** @phan-suppress-next-line PhanDeprecatedFunction */
        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->regions = null;
    }

    public function testGet()
    {
        $response = $this->regions->get();
        $this->assertInstanceOf(ApiResponse::class, $response);
    }

    public function testGetFiltered()
    {
        $response = $this->regions->getFiltered(['country_codes' => ['RU']]);
        $this->assertInstanceOf(ApiResponse::class, $response);
    }
}
