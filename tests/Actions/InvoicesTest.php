<?php

/**
 * Copyright (c) 2020. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\Tests\Actions;

use CdekSDK2\Actions\Invoices;
use CdekSDK2\BaseTypes\Invoice;
use CdekSDK2\BaseTypes\OrdersList;
use CdekSDK2\Client;
use CdekSDK2\Http\ApiResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\Psr18Client;

class InvoicesTest extends TestCase
{
    /**
     * @var Invoices
     */
    protected $invoices;


    protected function setUp()
    {
        parent::setUp();
        $psr18Client = new Psr18Client();
        $client = new Client($psr18Client);
        $client->setTest(true);
        $this->invoices = $client->invoice();
        \Doctrine\Common\Annotations\AnnotationReader::addGlobalIgnoredName('phan');

        /** @phan-suppress-next-line PhanDeprecatedFunction */
        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->invoices = null;
    }

    public function testAdd()
    {

        $invoice = Invoice::create([
            'orders' => [
                OrdersList::create([
                    'order_uuid' => 'fail-uuid'
                ]),
            ],
            'copy_count' => 1,
        ]);
        $this->assertTrue($invoice->validate());

        $response = $this->invoices->add($invoice);
        $this->assertInstanceOf(ApiResponse::class, $response);

//        $this->assertTrue($response->hasErrors());
//        $this->assertFalse($response->isOk());
    }


    public function testGet()
    {
        $response = $this->invoices->get('invoice');
        $this->assertInstanceOf(ApiResponse::class, $response);
    }

    public function testDownload()
    {
        $response = $this->invoices->download('invoice');
        $this->assertInstanceOf(ApiResponse::class, $response);
    }
}
