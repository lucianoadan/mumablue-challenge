<?php

// tests/Controller/PostControllerTest.php
namespace App\Tests\Controller;

use App\Tests\MockData;

use \GuzzleHttp\{RequestOptions, Client};
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ShipmentControllerTest extends WebTestCase
{
    static $API_BASE_URL = 'http://127.0.0.1:8000/api/';
    public function testCreateShipment()
    {
        $client = new Client();

        $response = $client->post(static::$API_BASE_URL.'shipments', [
            RequestOptions::JSON => MockData::$SAMPLE_SHIPMENT_JSON1,
        ]);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());

    }
}
