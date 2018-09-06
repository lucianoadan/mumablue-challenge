<?php

namespace App\Service\impl;

use App\Entity\Shipment;
use App\Service\CarrierServiceInterface;

class UpsCarrierService implements CarrierServiceInterface
{
    private $secret;
    private $userId;
    private $passwd;
    private $shipperNumber;
    private $testing;

    public function __construct()
    {
        $this->secret = getenv('UPS_API_SECRET');
        $this->userId = getenv('UPS_API_USERID');
        $this->passwd = getenv('UPS_API_PASSWD');
        $this->labelPath = getenv('SHIPMENT_LABEL_PATH');
        $this->shipperNumber = getenv('UPS_API_SHIPPER');
        $this->testing = true; // Para evitar disgustos no va por configuración!
    }
    public function getStatus(Shipment $shipmentData){

    }
    public function updateShipmentsStatus(){
        
    }
    public function ship(Shipment $shipmentData)
    {

        $orderRef = $shipmentData->getOrderRef();
        $shipToAddr = $shipmentData->getShipToAddr();
        // Start shipment
        $shipment = new \Ups\Entity\Shipment;

        // Set shipper
        $shipper = $shipment->getShipper();
        $shipper->setShipperNumber($this->shipperNumber);
        $shipper->setName('CuentiBlu SL');
        $shipper->setAttentionName('José Miguel Pérez');
        $shipperAddress = $shipper->getAddress();
        $shipperAddress->setAddressLine1('Calle Almendros 4');
        $shipperAddress->setPostalCode('28821');
        $shipperAddress->setCity('Coslada');
        $shipperAddress->setStateProvinceCode('28');
        $shipperAddress->setCountryCode('ES');
        $shipper->setAddress($shipperAddress);
        $shipper->setEmailAddress('shipments@cuentiblu.com');
        $shipper->setPhoneNumber('+34601602603');
        $shipment->setShipper($shipper);

        // To address
        $address = new \Ups\Entity\Address();
        $address->setAddressLine1($shipToAddr->getAddress());
        $address->setAddressLine2($shipToAddr->getAddress2());
        $address->setPostalCode($shipToAddr->getZip());
        $address->setCity($shipToAddr->getCity());
        $address->setStateProvinceCode($shipToAddr->getState());
        $address->setCountryCode($shipToAddr->getCountry());
        $shipTo = new \Ups\Entity\ShipTo();
        $shipTo->setAddress($address);

        if ($shipToAddr->getCompanyName() == null) {
            $shipTo->setCompanyName($shipToAddr->getAttentionName());
        } else {
            $shipTo->setCompanyName($shipToAddr->getCompanyName());
            $shipTo->setAttentionName($shipToAddr->getAttentionName());
        }

        $shipTo->setEmailAddress($shipToAddr->getEmail());
        $shipTo->setPhoneNumber($shipToAddr->getPhone());
        $shipment->setShipTo($shipTo);

        // From address
        $address = new \Ups\Entity\Address();
        $address->setAddressLine1('Calle Primavera 1');
        $address->setPostalCode('28850');
        $address->setCity('Torrejón de Ardoz');
        $address->setCountryCode('ES');
        $shipFrom = new \Ups\Entity\ShipFrom();
        $shipFrom->setAddress($address);
        $shipFrom->setName('Almacen CuentiBlu S.L.');
        $shipFrom->setAttentionName('Carmenta Gutierrez');
        $shipFrom->setCompanyName('CuentiBlu S.L.');
        $shipFrom->setEmailAddress('shipments@cuentiblu.com');
        $shipFrom->setPhoneNumber('+34601602604');
        $shipment->setShipFrom($shipFrom);

        // Set service
        $service = new \Ups\Entity\Service;
        $service->setCode(\Ups\Entity\Service::S_STANDARD);
        $service->setDescription($service->getName());
        $shipment->setService($service);

        // Set description
        $shipment->setDescription('Cuento Gominolas Niña');

        // Add Package
        $package = new \Ups\Entity\Package();
        $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);
        $package->getPackageWeight()->setWeight(10);
        $unit = new \Ups\Entity\UnitOfMeasurement;
        $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KGS);
        $package->getPackageWeight()->setUnitOfMeasurement($unit);

        // Set dimensions
        $dimensions = new \Ups\Entity\Dimensions();
        $dimensions->setHeight(50);
        $dimensions->setWidth(50);
        $dimensions->setLength(50);
        $unit = new \Ups\Entity\UnitOfMeasurement;
        $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_CM);
        $dimensions->setUnitOfMeasurement($unit);
        $package->setDimensions($dimensions);

        // Add descriptions because it is a package
        $package->setDescription('Cuento Gominolas Niña');

        // Add this package
        $shipment->addPackage($package);

        // Set Reference Number
        $referenceNumber = new \Ups\Entity\ReferenceNumber;

        $referenceNumber->setCode(\Ups\Entity\ReferenceNumber::CODE_INVOICE_NUMBER);
        $referenceNumber->setValue($orderRef);
        $shipment->setReferenceNumber($referenceNumber);

        // Set payment information
        $shipment->setPaymentInformation(new \Ups\Entity\PaymentInformation('prepaid', (object) array('AccountNumber' => $this->shipperNumber)));

        // Get shipment info
        $api = new \Ups\Shipping($this->secret, $this->userId, $this->passwd, $this->testing);
        $confirm = $api->confirm(\Ups\Shipping::REQ_VALIDATE, $shipment);

        if ($confirm) {

            $accept = $api->accept($confirm->ShipmentDigest);
            $base64image = $accept->PackageResults->LabelImage->GraphicImage;
            $labelPath = $this->saveLabel($orderRef, $base64image);
            // Update shipment data
            $shipmentData->setTrackingNum($confirm->ShipmentIdentificationNumber);
            $shipmentData->setLabelPath($labelPath);
        }

        return true;

    }

    private function saveLabel($name, $base64image)
    {
        $labelPath = $this->labelPath . '/' . $name . '.jpg';
        $ifp = fopen($labelPath, 'wb');
        fwrite($ifp, base64_decode($base64image));
        fclose($ifp);

        return $labelPath;
    }
}
