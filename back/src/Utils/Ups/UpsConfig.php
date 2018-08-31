<?php

namespace App\Utils\Ups;

class UpsConfig {
    private $secret;
    private $userId;
    private $passwd;
    private $shipperNumber;
    public function __construct(){
        $this->secret = getenv('UPS_API_SECRET');
        $this->userId = getenv('UPS_API_USERID');
        $this->passwd = getenv('UPS_API_PASSWD');
        $this->shipperNumber = getenv('UPS_API_SHIPPER');
    }

    /**
     * Get the value of secret
     */ 
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get the value of passwd
     */ 
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Get the value of shiperNumber
     */ 
    public function getShipperNumber()
    {
        return $this->shipperNumber;
    }
}
