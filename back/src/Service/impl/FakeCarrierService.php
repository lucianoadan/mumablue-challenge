<?php

namespace App\Service\impl;

use App\Entity\Shipment;
use App\Service\CarrierServiceInterface;

class FakeCarrierService implements CarrierServiceInterface
{
    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function ship(Shipment $shipmentData)
    {

        // Update shipment data
        $shipmentData->setTrackingNum($this->generateRandomString());
        $shipmentData->setLabelPath('fake_label.jpg');
        return true;
    }

}
