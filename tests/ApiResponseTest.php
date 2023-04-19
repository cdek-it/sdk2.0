<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\Tests;

use CdekSDK2\Http\ApiResponse;
use Nyholm\Psr7\Response;

class ApiResponseTest extends \PHPUnit\Framework\TestCase
{
    public function testConstruct()
    {
        $responsePSR7 = new Response(401, [], '{"error": "Server Error","message": "App Message"}');
        /** @var ApiResponse $response */
        $response = new ApiResponse($responsePSR7);
        $this->assertFalse($response->isOk());
        $this->assertTrue($response->hasErrors());
    }

    public function testIsOk()
    {
        /** @var ApiResponse $response */
        $response = new ApiResponse();
        $this->assertFalse($response->isOk());
    }

    public function testHasErrors()
    {
        /** @var ApiResponse $response */
        $response = new ApiResponse();
        $this->assertTrue($response->hasErrors());
    }

    public function testGetErrors()
    {
        /** @var ApiResponse $response */
        $response = new ApiResponse();
        $this->assertIsArray($response->getErrors());
        $this->assertArrayHasKey('code', $response->getErrors()[0]);
    }

    public function testGetStatus()
    {
        /** @var ApiResponse $response */
        $response = new ApiResponse();
        $this->assertEquals(500, $response->getStatus());
    }
}
