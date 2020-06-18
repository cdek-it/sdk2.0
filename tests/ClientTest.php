<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\Tests;

use CdekSDK2\Actions\Intakes;
use CdekSDK2\Actions\Offices;
use CdekSDK2\Actions\Orders;
use CdekSDK2\Actions\Webhooks;
use CdekSDK2\BaseTypes\Invoice;
use CdekSDK2\Constants;
use CdekSDK2\Dto\RegionList;
use CdekSDK2\Client;
use CdekSDK2\Exceptions\ParsingException;
use CdekSDK2\Http\ApiResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\Psr18Client;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    protected $client;
    protected function setUp()
    {
        parent::setUp();
        $psr18Client = new Psr18Client();
        $this->client = new Client($psr18Client);
        \Doctrine\Common\Annotations\AnnotationReader::addGlobalIgnoredName('phan');

        /** @phan-suppress-next-line PhanDeprecatedFunction */
        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->client = null;
    }

    public function testSetAccount()
    {
        $this->client->setAccount('newaccount');
        $this->assertStringContainsString('newaccount', $this->client->getAccount());
    }

    public function testGetAccount()
    {
        $this->client->setAccount('account');
        $this->assertStringContainsString('account', $this->client->getAccount());
    }

    public function testSetSecure()
    {
        $this->client->setSecure('newsecure');
        $this->assertStringContainsString('newsecure', $this->client->getSecure());
    }

    public function testIsTest()
    {
        $this->assertFalse($this->client->isTest());
    }

    public function testSetTest(): Client
    {
        $this->client->setTest(true);
        $this->assertTrue($this->client->isTest());
        $this->assertStringContainsString(Constants::TEST_ACCOUNT, $this->client->getAccount());
        $this->assertStringContainsString(Constants::TEST_SECURE, $this->client->getSecure());
        return $this->client;
    }

    public function testAuthorize()
    {
        $this->assertEmpty($this->client->getToken());
        $this->client->setTest(true);
        $this->client->authorize();
        $this->assertNotEmpty($this->client->getToken());
        $this->assertGreaterThan(time(), $this->client->getExpire());
    }

    /*
     * @covers \CdekSDK2\Client::getToken
     */
    public function testSetToken()
    {
        $this->client->setToken('qwerty');
        $this->assertStringContainsString('qwerty', $this->client->getToken());
    }

    public function testSetExpire()
    {
        $this->client->setExpire(1);
        $this->assertStringContainsString(1, $this->client->getExpire());
    }


    public function testIsExpired()
    {
        $this->assertTrue($this->client->isExpired());
    }


    public function testOrders()
    {
        $response = $this->client->orders();
        $this->assertInstanceOf(Orders::class, $response);
    }

    public function testOffices()
    {
        $response = $this->client->offices();
        $this->assertInstanceOf(Offices::class, $response);
    }

    public function testIntakes()
    {
        $response = $this->client->intakes();
        $this->assertInstanceOf(Intakes::class, $response);
    }

    public function testWebhooks()
    {
        $response = $this->client->webhooks();
        $this->assertInstanceOf(Webhooks::class, $response);
    }

    public function testFormatResponse()
    {
        $response = $this->createMock(ApiResponse::class);
        $response->method('getBody')
            ->willReturn('{"entity":{"uuid":"8bf0e8e2d724","orders":[{"order_uuid":"61a552583eb3"}],"copy_count":1,'
        . '"url":"","statuses":[{"code":"ACCEPTED","name":"Принят","date_time":"2020-02-11T17:52:45+0700"},'
        . '{"code":"PROCESSING","name":"Формируется","date_time":"2020-02-11T17:52:45+0700"}]},'
        . '"requests":[{"errors":[],"warnings":[]}]}');
        $invoice_response = $this->client->formatResponse($response, Invoice::class);
        $this->assertInstanceOf(Invoice::class, $invoice_response->entity);
    }

    public function testFormatResponseException()
    {
        $this->expectException(ParsingException::class);
        $response = $this->createMock(ApiResponse::class);
        $response->method('getBody')
            ->willReturn('{"type":"ORDER_STATUS","uuid":"c7e28f79fe39","url":"my_url"}');
        $hook = $this->client->formatResponse($response, 'SomeNotFoundClass');
    }

    public function testFormatResponseList()
    {
        $response = $this->createMock(ApiResponse::class);
        $response->method('getBody')
            ->willReturn('[{"country_code":"DE","region":"Нижняя Саксония","region_code":"641","country":"Германия"}]');
        $region_list = $this->client->formatResponseList($response, RegionList::class);
        $this->assertInstanceOf(RegionList::class, $region_list);
    }

    public function testFormatResponseListException()
    {
        $this->expectException(ParsingException::class);
        $response = $this->createMock(ApiResponse::class);
        $response->method('getBody')
            ->willReturn('[{"country_code":"DE","region":"Нижняя Саксония","region_code":"641","country":"Германия"}]');
        $hook = $this->client->formatResponseList($response, 'AnotherClass');
    }
}
