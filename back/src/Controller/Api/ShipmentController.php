<?php

namespace App\Controller\Api;

use App\Service\ShipmentServiceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;use Symfony\Component\HttpFoundation\Request;

class ShipmentController extends ApiController
{
    /**
     * Creates an Shipment resource
     * @Rest\Put("/shipments")
     * @param Request $request
     * @return ShipmentServiceInterface $shipmentService Business logic abstraction
     */
    public function createShipment(Request $request, ShipmentServiceInterface $shipmentService)
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
     * Get shipment
     * @Rest\Get("/shipments/{id}")
     * @param Request $request
     */
    public function getShipment($id, Request $request, ShipmentServiceInterface $shipmentService)
    {
        return $shipmentService->getShipment($id, $request);
    }

    /**
     * Get list of shipments with alerts
     * @Rest\Get("/alerts")
     * @param Request $request
     */
    public function getAlerts(Request $request, ShipmentServiceInterface $shipmentService)
    {
        
        return $shipmentService->getShipmentsWithAlert($request);
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

    /**
     * Get list of actual last statuses of shipments
     * @Rest\Get("/status/actual")
     * @param Request $request
     */
    public function getActualStatuses(Request $request, ShipmentServiceInterface $shipmentService)
    {
        return $shipmentService->getActualStatuses($request);
    }

    /**
     * Get list of status groups
     * @Rest\Get("/status-group")
     * @param Request $request
     */
    public function getStatusGroups(Request $request, ShipmentServiceInterface $shipmentService)
    {
        return $shipmentService->getStatusGroups($request);
    }

    

}
