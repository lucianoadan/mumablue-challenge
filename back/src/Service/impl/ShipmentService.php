<?php

namespace App\Service\impl;

use App\Entity\Shipment;
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

    public function __construct(ShipmentRepository $shipmentRepository, CarrierServiceInterface $carrierService, SerializerInterface $serializer)
    {

        $this->shipmentRepository = $shipmentRepository;
        $this->carrierService = $carrierService;
        $this->serializer = $serializer;
    }

    public function createShipment(Request $request): JsonResponse
    {

        $response = new ApiResponse($this->serializer);
        $validator = new ShipmentRequestValidator();

        $data = $request->request->all();
        $validator->validate($data);

        if ($validator->fails()) {
            $errors = $validator->errors();

            $response->setErrors($errors);
            $response->setMessage('Shipment creation request failed.');
            $response->setHttpStatus(Response::HTTP_BAD_REQUEST);
            return $response->getJsonResponse();
        }

        $shipment = Shipment::fill($data);
        try {
            $this->carrierService->ship($shipment);
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
            $response->setHttpStatus(Response::HTTP_BAD_REQUEST);
            $response->setMessageWithError('Unexpected error. Consult log for details.');

        }

        return $response->getJsonResponse();
    }

}
