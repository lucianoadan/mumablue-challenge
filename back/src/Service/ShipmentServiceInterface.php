<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

interface ShipmentServiceInterface
{

    /**
     * Create a shipment and send it to the carrier service to order a pick up and deliver
     */
    public function createShipment(Request $request): JsonResponse;
    /**
     * List of shipments
     */
    public function getShipments(Request $request) : JsonResponse;

    /**
     * List of shipments with alert
     */
    public function getShipmentsWithAlert(Request $request)  : JsonResponse;

    /**
     * List of countries available for shipping
     */
    public function getShippingCountries(Request $request)  : JsonResponse;

    /**
     * List of status which are the last status update of a shipment
     */
    public function getActualStatuses(Request $request)  : JsonResponse;

    /**
     * List of status groups
     */
    public function getStatusGroups(Request $request)  : JsonResponse;

    /**
     * Update the status of all undelivered shipments
     */
    public function updateShipmentsStatus();

}
