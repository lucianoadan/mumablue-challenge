<?php

namespace App\Service;

use App\Entity\Shipment;

interface CarrierServiceInterface {
    public function ship(Shipment $shipmentData);
}