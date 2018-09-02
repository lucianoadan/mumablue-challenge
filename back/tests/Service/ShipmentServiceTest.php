<?php
// tests/Controller/PostControllerTest.php
namespace App\Tests\Controller;

use App\Entity\Shipment;
use App\Tests\MockData;use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

class ShipmentServiceTest extends KernelTestCase
{

    /**
     * @var \App\Service\ShipmentService
     */
    private $shipmentService;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->shipmentService = $kernel->getContainer()->get('app.shipment_service');
    }

    public function testCreateShipment()
    {


        $request = new Request(
            $_GET,
            MockData::$SAMPLE_SHIPMENT_JSON1,
            array(),
            $_COOKIE,
            $_FILES,
            $_SERVER
        );

        $response = $this->shipmentService->createShipment($request);
        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('payload', $data);
        $this->assertArrayHasKey('id', $data['payload']);
    }
}
