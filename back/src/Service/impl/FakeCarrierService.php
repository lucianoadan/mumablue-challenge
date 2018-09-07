<?php

namespace App\Service\impl;

use App\Entity\Shipment;
use App\Entity\StatusUpdate;
use App\Repository\ShipmentHeaderRepository;
use App\Repository\ShipmentRepository;
use App\Repository\StatusRepository;
use App\Repository\StatusUpdateRepository;
use App\Service\CarrierServiceInterface;

class FakeCarrierService implements CarrierServiceInterface
{
    private $shipmentRepository;
    private $statusRepository;
    private $statusUpdateRepository;
    private $shipmentHeaderRepository;
    public function __construct(
        ShipmentRepository $shipmentRepository,
        ShipmentHeaderRepository $shipmentHeaderRepository,
        StatusRepository $statusRepository,
        StatusUpdateRepository $statusUpdateRepository
    ) {
        $this->shipmentRepository = $shipmentRepository;
        $this->statusRepository = $statusRepository;
        $this->shipmentHeaderRepository = $shipmentHeaderRepository;
        $this->statusUpdateRepository = $statusUpdateRepository;
    }
    public function ship(Shipment $shipmentData)
    {

        // Update shipment data
        $shipmentData->setTrackingNum($this->generateRandomString());
        $shipmentData->setLabelPath('fake_label.jpg');
        return true;
    }
    public function getStatus(Shipment $shipment)
    {

        // FAKE DATA
        $statuses = $this->statusRepository->findAll();
        $status = $statuses[array_rand($statuses, 1)];
        $deliveryDate = new \DateTime();
        $days = random_int(1, 7);
        $deliveryDate->modify('+' . $days . ' day');

        // Entities
        $statusUpdate = new StatusUpdate();
        $statusUpdate->setStatus($status);
        $statusUpdate->setShipment($shipment);
        $shipment->setEstDeliveryDate($deliveryDate);
        $shipment->addStatus($statusUpdate);

        $this->shipmentRepository->update($shipment, $statusUpdate);
    }

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

}
