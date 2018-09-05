<?php

namespace App\Utils\Api;

use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
class ApiResponse
{
    private $serializer;
    private $message = null;
    private $payload = null;
    private $errors = false;
    private $headers = [];
    private $httpStatus = Response::HTTP_OK;

    public function __construct()
    {
        $sb = SerializerBuilder::create();
        $sb->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy());
        $this->serializer = $sb->build();

    }

    public function getJsonResponse(): JsonResponse
    {
        $json = ['errors' => $this->errors];
        if ($this->payload) {
            $json['payload'] = $this->payload;
        }

        if ($this->message) {
            $json['message'] = $this->message;
        }

        return new JsonResponse($this->serializer->serialize($json, 'json'), $this->httpStatus, $this->headers, true);
    }

    /**
     * Set a message with the error predefined to itself
     * because the API consumer will check if there was an error looking if errors != false
     */
    public function setMessageWithError($message)
    {
        $this->message = $message;
        $this->errors = [$message];
    }
    /**
     * Get the value of httpStatus
     */
    public function getHttpStatus()
    {
        return $this->httpStatus;
    }

    /**
     * Set the value of httpStatus
     *
     * @return  self
     */
    public function setHttpStatus($httpStatus)
    {
        $this->httpStatus = $httpStatus;

        return $this;
    }

    /**
     * Get the value of headers
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set the value of headers
     *
     * @return  self
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Get the value of errors
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set the value of errors
     *
     * @return  self
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * Get the value of payload
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * Set the value of payload
     *
     * @return  self
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * Get the value of message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
}
