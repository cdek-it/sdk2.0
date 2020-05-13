<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\Tests\Actions;

use CdekSDK2\Actions\Intakes;
use CdekSDK2\BaseTypes\Intake;
use CdekSDK2\Client;
use CdekSDK2\Http\ApiResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\Psr18Client;

class IntakesTest extends TestCase
{
    /**
     * @var Intakes
     */
    protected $intake;


    protected function setUp()
    {
        parent::setUp();
        $psr18Client = new Psr18Client();
        $client = new Client($psr18Client);
        $client->setTest(true);
        $this->intake = $client->intakes();
        \Doctrine\Common\Annotations\AnnotationReader::addGlobalIgnoredName('phan');

        /** @phan-suppress-next-line PhanDeprecatedFunction */
        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->intake = null;
    }

    public function testAdd()
    {
        $intake = Intake::create([]);
        $intake->intake_date = date('Y-m-d', time() + 2 * 24 * 60 * 60);
        $intake->intake_time_from = '09:00';
        $intake->intake_time_to = '19:00';
        $intake->name = uniqid('sdk-2.0-', true);
        $intake->weight = 10000;
        $intake->sender = \CdekSDK2\BaseTypes\Contact::create([
            'name' => 'Иван Васильев',
            'company' => 'CDEK-IT',
            'email' => 'ivanvasjljev@cdek.it',
            'phones' => [
                \CdekSDK2\BaseTypes\Phone::create(['number' => '+79999999999'])
            ]
        ]);
        ;
        $intake->from_location = \CdekSDK2\BaseTypes\Location::create([
            'address' => 'Кутузовский проспект 1-1',
            'code' => 137,
            'country_code' => 'RU'
        ]);

        $this->assertTrue($intake->validate());
        $response = $this->intake->add($intake);
        $this->assertTrue($response->isOk());
        $this->assertFalse($response->hasErrors());
    }

    public function testDelete()
    {
        $response = $this->intake->delete('intake');
        $this->assertInstanceOf(ApiResponse::class, $response);
    }

    public function testGet()
    {
        $response = $this->intake->get('intake');
        $this->assertInstanceOf(ApiResponse::class, $response);
    }
}
