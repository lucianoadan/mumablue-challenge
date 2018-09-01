<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Shipment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $orderRef;

    /**
     * @ORM\Column(type="string", length=255, nullable=true))
     */
    private $trackingNum;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Address", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $billingAddress;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Address", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $deliveryAddress;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $deliveryInstructions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrackingNum(): ?string
    {
        return $this->trackingNum;
    }

    public function setTrackingNum(string $trackingNum): self
    {
        $this->trackingNum = $trackingNum;

        return $this;
    }

    public function getBillingAddress(): ?Address
    {
        return $this->billingAddress;
    }

    public function setBillingAddress(Address $billingAddress): self
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    public function getDeliveryAddress(): ?Address
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(Address $deliveryAddress): self
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    public function getOrderRef(): ?string
    {
        return $this->orderRef;
    }

    public function setOrderRef(string $orderRef): self
    {
        $this->orderRef = $orderRef;

        return $this;
    }

    public function getDeliveryInstructions(): ?string
    {
        return $this->deliveryInstructions;
    }

    public function setDeliveryInstructions(?string $deliveryInstructions): self
    {
        $this->deliveryInstructions = $deliveryInstructions;

        return $this;
    }
}
