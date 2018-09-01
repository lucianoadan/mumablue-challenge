<?php

namespace App\Service\impl;

use App\Entity\{Address, Shipment};
use App\Repository\ShipmentRepository;
use App\Service\ShipmentServiceInterface;

class ShipmentService implements ShipmentServiceInterface
{

    private $shipmentRepository;
    private $hydrator;

    public function __construct(ShipmentRepository $shipmentRepository)
    {
        $this->shipmentRepository = $shipmentRepository;
    }

    public function createShipment($request): Shipment
    {

        $data = $request->request->all();

        // set data
        $shipment = new Shipment();
        $shipment->setOrderRef($data['orderRef']);
        $shipment->setTrackingNum('xxxx');
        $shipment->setDeliveryComment($data['deliveryComment']);

        $billingAddress = new Address();
        $billingAddress->setAddress($data['billingAddress']['address']);
        $billingAddress->setAddress2($data['billingAddress']['address2']);
        $billingAddress->setCity($data['billingAddress']['city']);
        $billingAddress->setZip($data['billingAddress']['zip']);
        $billingAddress->setState($data['billingAddress']['state']);
        $billingAddress->setCountry($data['billingAddress']['country']);
        $billingAddress->setFirstname($data['billingAddress']['firstname']);
        $billingAddress->setLastname($data['billingAddress']['lastname']);
        $billingAddress->setPhone($data['billingAddress']['phone']);
        $billingAddress->setEmail($data['billingAddress']['email']);

        if ($data['sameAddresses']) {
            $deliveryAddress = $billingAddress;
        } else {
            $deliveryAddress = new Address();
            $deliveryAddress->setAddress($data['deliveryAddress']['address']);
            $deliveryAddress->setAddress2($data['deliveryAddress']['address2']);
            $deliveryAddress->setCity($data['deliveryAddress']['city']);
            $deliveryAddress->setZip($data['deliveryAddress']['zip']);
            $deliveryAddress->setState($data['deliveryAddress']['state']);
            $deliveryAddress->setCountry($data['deliveryAddress']['country']);
            $deliveryAddress->setFirstname($data['deliveryAddress']['firstname']);
            $deliveryAddress->setLastname($data['deliveryAddress']['lastname']);
            $deliveryAddress->setPhone($data['deliveryAddress']['phone']);
            $deliveryAddress->setEmail($data['deliveryAddress']['email']);
        }

        $shipment->setBillingAddress($billingAddress);
        $shipment->setDeliveryAddress($deliveryAddress);


        
        $this->shipmentRepository->create($shipment);

        return $shipment;
    }

}
