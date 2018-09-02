<?php
namespace App\Tests;

class MockData {
    static $SAMPLE_SHIPMENT_JSON1 = [
        "orderRef" => "P00001",
        "sameAddresses" => false,
        "deliveryInstructions" => "",
        "billingAddress" => [
            "firstname" => "Sergio",
            "lastname" => "Lopez",
            "address" => "Calle Milán 31",
            "address2" => "Escalera izquierda",
            "city" => "Torrejón de Ardoz",
            "zip" => "28850",
            "state" => "Madrid",
            "country" => "ES",
            "email" => "sergiazow@gmail.com",
            "phone" => "628178737",
        ],
        "deliveryAddress" => [
            "firstname" => "Sergio",
            "lastname" => "Lopez",
            "address" => "Alcala 43",
            "address2" => "",
            "city" => "Madrid",
            "zip" => "28014",
            "state" => "Madrid",
            "country" => "ES",
            "email" => "sergiazow@gmail.com",
            "phone" => "628178737",
        ],
    ];
}