<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

interface ShipmentServiceInterface
{

    public function createShipment(Request $request): JsonResponse;

}
