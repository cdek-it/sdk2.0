<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\Tests\Actions;

use CdekSDK2\Actions\Webhooks;
use CdekSDK2\Dto\InputHook;
use CdekSDK2\BaseTypes\WebHook;
use CdekSDK2\Client;
use CdekSDK2\Constants;
use CdekSDK2\Http\ApiResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\Psr18Client;

class WebhooksTest extends TestCase
{
    /**
     * @var Webhooks
     */
    protected $webhooks;

    protected function setUp()
    {
        parent::setUp();
        $client = new Client(new Psr18Client());
        $client->setTest(true);
        $this->webhooks = $client->webhooks();
        \Doctrine\Common\Annotations\AnnotationReader::addGlobalIgnoredName('phan');

        /** @phan-suppress-next-line PhanDeprecatedFunction */
        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->webhooks = null;
    }

    public function testParseHookStatus()
    {
        $input_hook = '{
  "type": "ORDER_STATUS",
  "date_time": "2019-07-11T13:07:34+0700",
  "uuid": "72753031-8347-40c0-ab0f-1a49c7a262c1",
  "attributes": {
    "cdek_number": "1106153417",
    "number": "1106152821",
    "status_code": "4",
    "status_date_time": "2019-07-11T12:41:43+0700",
    "city": "Новосибирск"
  }
}';
        $hook = $this->webhooks->parse($input_hook);
        $this->assertInstanceOf(InputHook::class, $hook);
        $this->assertStringContainsString(Constants::HOOK_TYPE_STATUS, $hook->type);
    }

    public function testParseHookPrint()
    {
        $input_hook = '{
  "type": "PRINT_FORM",
  "date_time": "2019-07-11T13:07:34+0700",
  "uuid": "72753031-8347-40c0-ab0f-1a49c7a262c1",
  "attributes": {
    "type": "barcode",
    "url": "https://api.cdek.ru/v2/print/barcodes/{uuid}.pdf"
  }
}';
        $hook = $this->webhooks->parse($input_hook);
        $this->assertInstanceOf(InputHook::class, $hook);
        $this->assertStringContainsString(Constants::HOOK_PRINT_STATUS, $hook->type);
        $this->assertStringContainsString(Constants::PRINT_TYPE_BARCODE, $hook->attributes->type);
    }

    public function testParseHookFailData()
    {
        $hook = $this->webhooks->parse('<xml/>');
        $this->assertNull($hook->type);
    }

    public function testAdd()
    {
        $response = $this->webhooks->add(new WebHook([]));
        $this->assertInstanceOf(ApiResponse::class, $response);
    }

    public function testDelete()
    {
        $response = $this->webhooks->delete('webhook');
        $this->assertInstanceOf(ApiResponse::class, $response);
    }

    public function testGet()
    {
        $response = $this->webhooks->get('webhook');
        $this->assertInstanceOf(ApiResponse::class, $response);
    }

    public function testList()
    {
        $response = $this->webhooks->list();
        $this->assertInstanceOf(ApiResponse::class, $response);
    }
}
