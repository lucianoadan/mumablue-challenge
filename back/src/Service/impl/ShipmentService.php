<?php

namespace App\Service\impl;

use App\Entity\Shipment;
use App\Repository\CountryRepository;
use App\Repository\ShipmentRepository;
use App\Service\CarrierServiceInterface;
use App\Service\ShipmentServiceInterface;
use App\Utils\Api\ApiResponse;
use App\Validator\ShipmentRequestValidator;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class ShipmentService implements ShipmentServiceInterface
{

    private $shipmentRepository;
    private $carrierService;
    private $serializer;

    public function __construct(
        ShipmentRepository $shipmentRepository,
        CountryRepository $countryRepository,
        CarrierServiceInterface $carrierService,
        SerializerInterface $serializer) {

        $this->shipmentRepository = $shipmentRepository;
        $this->countryRepository = $countryRepository;
        $this->carrierService = $carrierService;
        $this->serializer = $serializer;
    }
    /**
     * Create a shipment and send it to the carrier service to order a pick up and deliver
     */
    public function createShipment(Request $request): JsonResponse
    {

        $response = new ApiResponse($this->serializer);
        $validator = new ShipmentRequestValidator($this->countryRepository, $this->shipmentRepository);

        $data = $request->request->all();
        $validator->validate($data);

        if ($validator->fails()) {
            $errors = $validator->errors();

            $response->setErrors($errors);
            // Especial error
            if ($errors['orderRef']) {
                $errorMsg = $errors['orderRef'][0];
            } else {
                $errorMsg = 'Solicitud incorrecta. Revisa el formulario.';
            }
            $response->setMessage($errorMsg);
            $response->setHttpStatus(Response::HTTP_BAD_REQUEST);
            return $response->getJsonResponse();
        }

        // Add existing relation
        $data['shipToAddr']['country'] = $this->countryRepository->find($data['shipToAddr']['country']);
        $shipment = Shipment::fill($data);

        try {
            //$this->carrierService->ship($shipment);
        } catch (Exception $ex) {
            $response->setHttpStatus(Response::HTTP_BAD_REQUEST);
            $response->setMessageWithError('Carrier Error: ' . $ex->getMessage());
            return $response->getJsonResponse();
        }
        try {
            $this->shipmentRepository->create($shipment);
            $response->setPayload($shipment);
            $response->setHttpStatus(Response::HTTP_CREATED);
        } catch (Exception $ex) {
            $response->setHttpStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
            var_dump($ex->getMessage());
            $response->setMessageWithError('Unexpected error. Consult log for details.');

        }

        return $response->getJsonResponse();
    }
    /**
     * List of shipments
     */
    public function getShipments(Request $request){
        $response = new ApiResponse($this->serializer);

        $shipments = $this->shipmentRepository->findAll();
        $response->setPayload($shipments);

        return $response->getJsonResponse();
    }
    /**
     * List of countries available for shipping
     */
    public function getShippingCountries(Request $request)
    {

        $response = new ApiResponse($this->serializer);
        try {
            $countries = $this->countryRepository->findShippingCountries();
            $response->setPayload($countries);
        } catch (Exception $ex) {
            $response->setHttpStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->setMessageWithError('Unexpected error. Consult log for details.');

        }

        return $response->getJsonResponse();
    }

}
