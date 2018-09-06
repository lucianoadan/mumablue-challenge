<?php

namespace App\Entity;

use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use \Datetime;
use JMS\Serializer\Annotation\Accessor;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @UniqueEntity("orderRef")
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
     * @Assert\NotBlank()
     */
    private $orderRef;

    /**
     * @ORM\Column(type="string", length=255, nullable=true))
     */
    private $trackingNum;

    /**
     * @ORM\Column(type="string", length=255, nullable=true))
     */
    private $labelPath;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Address", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $shipToAddr;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $deliveryInstructions;

    /**
     * @ORM\Column(type="datetime", nullable = false)
     * @Assert\NotNull()
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StatusUpdate", mappedBy="shipment", orphanRemoval=true, cascade={"persist"})
     */
    private $statuses;

    /** @Accessor(getter="getLabelUrl") */
    private $labelUrl;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->statuses = new ArrayCollection();
        $this->labelUrl = null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrackingNum(): ?string
    {
        return $this->trackingNum;
    }

    public function getCreatedAt(): ?Datetime
    {
        return $this->createdAt;
    }

    public function setTrackingNum(string $trackingNum): self
    {
        $this->trackingNum = $trackingNum;

        return $this;
    }

    public function getShipToAddr(): ?Address
    {
        return $this->shipToAddr;
    }

    public function setShipToAddr(Address $shipToAddr): self
    {
        $this->shipToAddr = $shipToAddr;

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

    public function getLabelUrl()
    {
        if ($this->labelPath !== null) {
            return getenv('APP_BASEURL') . '/' . $this->labelPath;
        }

        return null;
    }

    public function getLabelPath()
    {
        return $this->labelPath;
    }

    public function setLabelPath($labelPath)
    {
        $this->labelPath = $labelPath;

        return $this;
    }

    public static function fill($data): ?Shipment
    {
        $shipment = new Shipment();
        $shipment->setOrderRef($data['orderRef']);

        if (isset($data['deliveryInstructions'])) {
            $shipment->setDeliveryInstructions($data['deliveryInstructions']);
        }

        $shipment->setShipToAddr(Address::fill($data['shipToAddr']));

        return $shipment;
    }

    /**
     * @return Collection|StatusUpdate[]
     */
    public function getStatuses(): Collection
    {
        return $this->statuses;
    }

    public function addStatus(StatusUpdate $status): self
    {
        if (!$this->statuses->contains($status)) {
            $this->statuses[] = $status;
            $status->setShipment($this);
        }

        return $this;
    }

    public function removeStatus(StatusUpdate $status): self
    {
        if ($this->statuses->contains($status)) {
            $this->statuses->removeElement($status);
            // set the owning side to null (unless already changed)
            if ($status->getShipment() === $this) {
                $status->setShipment(null);
            }
        }

        return $this;
    }

}
