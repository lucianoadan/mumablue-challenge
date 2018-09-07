<?php

namespace App\Service;

use App\Entity\Shipment;

interface CarrierServiceInterface {
    /**
     * Send request of sending shipment to the carrier provider
     */
    public function ship(Shipment $shipmentData);
    /**
     * Track the shipment
     */
    public function getStatus(Shipment $shipmentData);

   

    
}