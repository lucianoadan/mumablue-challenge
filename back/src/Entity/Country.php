<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 */
class Country
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $invoice;

    /**
     * @ORM\Column(type="boolean")
     */
    private $availableShipping;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getInvoice(): ?bool
    {
        return $this->invoice;
    }

    public function setInvoice(bool $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getAvailableShipping(): ?bool
    {
        return $this->availableShipping;
    }

    public function setAvailableShipping(bool $availableShipping): self
    {
        $this->availableShipping = $availableShipping;

        return $this;
    }

    
   
}
