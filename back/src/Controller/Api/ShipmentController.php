<?php

namespace App\Controller\Api;

use App\Service\ShipmentServiceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShipmentController extends ApiController
{
    /**
     * Creates an Shipment resource
     * @Rest\Post("/shipments")
     * @param Request $request
     * @return ShipmentServiceInterface $shipmentService Business logic abstraction
     */
    public function postShipment(Request $request, ShipmentServiceInterface $shipmentService)
    {
        $shipment = $shipmentService->createShipment($request);

        return $this->response($shipment, Response::HTTP_CREATED);
    }
    
}
