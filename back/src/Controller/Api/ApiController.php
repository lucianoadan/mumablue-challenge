<?php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Serializer\SerializerInterface;

abstract class ApiController extends FOSRestController
{
    public function __construct(SerializerInterface $serializer){
        $this->serializer = $serializer;
    }

}
