<?php

namespace App\Controller\Api;

use App\Service\OrderService;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class OrderController extends ApiController
{
    /**
     * Creates an Order resource
     * @Rest\Post("/orders")
     * @param Request $request
     * @return OrderService $orderService Business logic abstraction
     */
    public function postOrder(Request $request, OrderService $orderService)
    {
        return $orderService->createOrder($request);
    }
    
}
