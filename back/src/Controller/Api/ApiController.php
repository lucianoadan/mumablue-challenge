<?php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\{JsonResponse, Response};

abstract class ApiController extends FOSRestController
{
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    protected function response($payload, $httpStatus = Response::HTTP_OK, $errors = false) : JsonResponse
    {
        return new JsonResponse($this->serializer->serialize([
            'payload' => $payload,
            'errors' => $errors,
        ], 'json'), $httpStatus,[], true);

    }
}
