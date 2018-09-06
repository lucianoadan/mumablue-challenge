<?php

namespace App\Service\impl;

use App\Entity\Shipment;
use App\Entity\StatusUpdate;

use App\Repository\StatusUpdateRepository;
use App\Repository\ShipmentRepository;
use App\Repository\StatusRepository;
use App\Service\CarrierServiceInterface;

class FakeCarrierService implements CarrierServiceInterface
{
    private $shipmentRepository;
    private $statusRepository;
    private $statusUpdateRepository;

    public function __construct(
        ShipmentRepository $shipmentRepository,
        StatusRepository $statusRepository,
        StatusUpdateRepository $statusUpdateRepository
    ) {
        $this->shipmentRepository = $shipmentRepository;
        $this->statusRepository = $statusRepository;

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
        $statusCodes = ['000', '003', '005', '006', '007', '010', '011', '012', '013', '014', '016', '017', '018', '019', '020', '021', '022', '023', '024', '025', '026', '027', '028', '029', '030', '032', '033', '034', '035', '036', '037', '038', '039', '040', '041', '042', '043', '044', '045', '046', '047', '048', '049', '050', '051', '052', '053', '054', '055', '056', '057', '058', '059', '060', '061', '062', '063', '064', '065', '066', '067', '068', '069'];
        $code = array_rand($statusCodes, 1);
        $status = $this->statusRepository->findByCode($code);

        $statusUpdate = new StatusUpdate();
        $statusUpdate->setStatus($status);
        $statusUpdate->setShipment($shipment);
        $shipment->addStatus($statusUpdate);
        $this->shipmentRepository->update($shipment, $statusUpdate);
    }

    public function updateShipmentsStatus()
    {

        $shipments = $this->shipmentRepository->findNotDelivered();
        foreach ($shipments as $shipment) {
            $this->getStatus($shipment);
        }

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
