<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShipmentHeaderRepository", readOnly=true)
 * @ORM\Table(name="vw_shipment_hdr")
 */
class ShipmentHeader
{
    /**
     * @ORM\Id()
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
    private $statusId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statusCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statusName;

    /**
     * @ORM\Column(type="integer")
     */
    private $statusGroupId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statusGroupCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statusGroupName;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statusGroupColor;

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


    public function getStatusId(): ?int
    {
        return $this->statusId;
    }


    public function getStatusCode(): ?string
    {
        return $this->statusCode;
    }


    public function getStatusName(): ?string
    {
        return $this->statusName;
    }


    public function getStatusGroupId(): ?int
    {
        return $this->statusGroupId;
    }


    public function getStatusGroupCode(): ?string
    {
        return $this->statusGroupCode;
    }


    public function getStatusGroupName(): ?string
    {
        return $this->statusGroupName;
    }

    public function getStatusGroupColor(): ?string
    {
        return $this->statusGroupColor;
    }


    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

}
