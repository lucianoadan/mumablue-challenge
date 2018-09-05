<?php

namespace App\Controller\Api;

use App\Service\ShipmentServiceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

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
        return $shipmentService->createShipment($request);
    }
    
    /**
     * Get list of shipments
     * @Rest\Get("/shipments")
     * @param Request $request
     */
    public function getShipments(Request $request, ShipmentServiceInterface $shipmentService)
    {
        return $shipmentService->getShipments($request);
    }

    /**
     * Get list of available countries for shipping
     * @Rest\Get("/countries/available")
     * @param Request $request
     */
    public function getShippingCountries(Request $request, ShipmentServiceInterface $shipmentService)
    {
        return $shipmentService->getShippingCountries($request);
    }

    

}
