<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
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
     * @ORM\Column(type="integer")
     */
    private $billingAddressId;

    /**
     * @ORM\Column(type="integer")
     */
    private $deliveryAddressId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBillingAddressId(): ?int
    {
        return $this->billingAddressId;
    }

    public function setBillingAddressId(int $billingAddressId): self
    {
        $this->billingAddressId = $billingAddressId;

        return $this;
    }

    public function getDeliveryAddressId(): ?int
    {
        return $this->deliveryAddressId;
    }

    public function setDeliveryAddressId(int $deliveryAddressId): self
    {
        $this->deliveryAddressId = $deliveryAddressId;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
