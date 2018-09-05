<?php

namespace App\Service\impl;

use App\Entity\Shipment;
use App\Repository\CountryRepository;
use App\Repository\ShipmentRepository;
use App\Repository\StatusGroupRepository;
use App\Repository\StatusRepository;
use App\Service\CarrierServiceInterface;
use App\Service\ShipmentServiceInterface;
use App\Utils\Api\ApiResponse;
use App\Validator\ShipmentRequestValidator;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShipmentService implements ShipmentServiceInterface
{

    private $shipmentRepository;
    private $carrierService;
    private $countryRepository;
    private $statusRepository;

    public function __construct(
        ShipmentRepository $shipmentRepository,
        StatusRepository $statusRepository,
        CountryRepository $countryRepository,
        StatusGroupRepository $statusGroupRepository,
        CarrierServiceInterface $carrierService) {

        $this->shipmentRepository = $shipmentRepository;
        $this->statusRepository = $statusRepository;
        $this->statusGroupRepository = $statusGroupRepository;
        $this->countryRepository = $countryRepository;
        $this->carrierService = $carrierService;
    }
    /**
     * Create a shipment and send it to the carrier service to order a pick up and deliver
     */
    public function createShipment(Request $request): JsonResponse
    {

        $response = new ApiResponse();
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
    public function getShipments(Request $request)
    {
        $response = new ApiResponse();
        $data = $request->request->all();
        if (isset($data['status'])) {
            $shipments = $this->shipmentRepository->findWhereLastStatus($data['status']['id']);
        } else if (isset($data['statusGroup'])) {
            $shipments = $this->shipmentRepository->findWhereLastStatusInGroup($data['statusGroup']['id']);
        } else {
            $shipments = $this->shipmentRepository->findAll();
        }
        $response->setPayload($shipments);

        return $response->getJsonResponse();
    }
    /**
     * List of countries available for shipping
     */
    public function getShippingCountries(Request $request)
    {

        $response = new ApiResponse();
        try {
            $countries = $this->countryRepository->findShippingCountries();
            $response->setPayload($countries);
        } catch (Exception $ex) {
            $response->setHttpStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->setMessageWithError('Unexpected error. Consult log for details.');

        }

        return $response->getJsonResponse();
    }

    public function getActualStatuses(Request $request)
    {
        $response = new ApiResponse();
        try {
            $statuses = $this->statusRepository->getActualStatuses();
            $response->setPayload($statuses);
        } catch (Exception $ex) {
            $response->setHttpStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->setMessageWithError('Unexpected error. Consult log for details.');
        }
        return $response->getJsonResponse();
    }

    public function getStatusGroups(Request $request)
    {
        $response = new ApiResponse();

        try {
            $groups = $this->statusGroupRepository->findAll();
            $response->setPayload($groups);
        } catch (Exception $ex) {
            $response->setHttpStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->setMessageWithError('Unexpected error. Consult log for details.');

        }

        return $response->getJsonResponse();
    }

}
