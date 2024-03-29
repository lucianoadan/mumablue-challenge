<?php

namespace App\Service\impl;

use App\Entity\Shipment;
use App\Repository\CountryRepository;
use App\Repository\ShipmentHeaderRepository;
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
        ShipmentHeaderRepository $shipmentHdrRepository,
        StatusRepository $statusRepository,
        CountryRepository $countryRepository,
        StatusGroupRepository $statusGroupRepository,
        CarrierServiceInterface $carrierService
    ) {

        $this->shipmentHdrRepository = $shipmentHdrRepository;
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
            if (isset($errors['orderRef'])) {
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
            $this->carrierService->ship($shipment);
            $this->carrierService->getStatus($shipment);
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
    public function getShipments(Request $request)  : JsonResponse
    {
        $response = new ApiResponse();
        $filters = $request->query->all();
        $headersOnly = (isset($filters['lightweight']) && $filters['lightweight']);
        $shipmentRepo = $headersOnly ? $this->shipmentHdrRepository : $this->shipmentRepository;

        if (isset($filters['status_id'])) {
            $shipments = $shipmentRepo->findWhereLastStatus($filters['status_id']);
        } else if (isset($filters['status_group_id'])) {
            $shipments = $shipmentRepo->findWhereLastStatusInGroup($filters['status_group_id']);
        } else {
            $shipments = $shipmentRepo->findAll();
        }
        $response->setPayload($shipments);

        return $response->getJsonResponse();
    }

    /**
     * Get shipment
     */
    public function getShipment($id, Request $request) : JsonResponse
    {
        $response = new ApiResponse();

        $shipment = $this->shipmentRepository->find(intval($id));
        if($shipment == null){
            $response->setErrors(["Envío no encontrado"]);
            $response->setMessage("Envío no encontrado");
            return $response->getJsonResponse();
        }
        /*
         Fetch last available status:
         Commented because in the FakeCarrierService 
         a new status is always added to non-delivered shipments
        $this->carrierService->getStatus($shipment);
        */

        $response->setPayload($shipment);

        return $response->getJsonResponse();
    }

    /**
     * List of shipments with alerts
     */
    public function getShipmentsWithAlert(Request $request) : JsonResponse
    {
        $response = new ApiResponse();
        $group = $this->statusGroupRepository->findByCode('alert');
        $shipments = $this->shipmentRepository->findWhereLastStatusInGroup($group->getId());
        $response->setPayload($shipments);

        return $response->getJsonResponse();
    }

    /**
     * List of countries available for shipping
     */
    public function getShippingCountries(Request $request) : JsonResponse
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

    public function getActualStatuses(Request $request) : JsonResponse
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

    public function getStatusGroups(Request $request) : JsonResponse
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

    /**
     * Update the status of all undelivered shipments
     */
    public function updateShipmentsStatus()
    {

        // IDs of not delivered shipments
        $notDeliveredShipments = $this->shipmentHdrRepository->findNotDelivered();
        $shipmentIds = array_map(function ($s) {
            return $s->getId();
        }, $notDeliveredShipments);
        // get all shipments by those ids
        $shipments = $this->shipmentRepository->findBy([
            'id' => $shipmentIds,
        ]);
        foreach ($shipments as $shipment) {
            $this->carrierService->getStatus($shipment);
        }

    }

}
