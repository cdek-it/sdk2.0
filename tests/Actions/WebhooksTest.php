<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace Tests\CdekSDK2\Actions;

use CdekSDK2\Actions\Webhooks;
use CdekSDK2\BaseTypes\InputHook;
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

    public function testParseHook()
    {
        $hook = $this->webhooks->parse('{"type":"ORDER_STATUS","date_time":"2019-10-04T11:16:26+0700",' .
            '"uuid":"7275","attributes":{"cdek_number":"2083","status_code":"1",' .
            '"number":"7275","status_date_time":"2019-10-04T11:16:21+0700"}}');
        $this->assertInstanceOf(InputHook::class, $hook);
        $this->assertStringContainsString(Constants::HOOK_TYPE_STATUS, $hook->type);
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
