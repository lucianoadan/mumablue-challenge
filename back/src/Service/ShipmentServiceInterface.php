<?php

namespace App\Service;

use App\Entity\Shipment;


interface ShipmentServiceInterface {
    
    public function createShipment($request) : Shipment;
    
}