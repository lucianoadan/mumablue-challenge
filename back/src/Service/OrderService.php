<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\{Response, JsonResponse};
use Symfony\Component\Serializer\SerializerInterface;

use App\Repository\OrderRepository;
use App\Entity\Order;
use App\Utils\Api\ApiResponse;





class OrderService {
    private $serializer;
    private $orderRepository;
    public function __construct(SerializerInterface $serializer, OrderRepository $orderRepository){
        $this->orderRepository = $orderRepository;
        $this->serializer = $serializer;
    }

    public function createOrder($request) {
        
    
        $order = new Order();
        $order->setOrderRef('P0123ABC');
        //$this->orderRepository->create($order);

        return $this->response($order, Response::HTTP_CREATED);
    }

    private function response($payload, $httpStatus = Response::HTTP_OK, $errors = false){

        return new Response($this->serializer->serialize([
            'payload' => $payload,
            'errors' => $errors
        ], 'json'), $httpStatus);

    }
}