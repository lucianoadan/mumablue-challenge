<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;
/**
 * @ORM\Entity(repositoryClass="App\Repository\QAReviewRepository")
 */
class QAReview
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

  

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\QAReviewAnswer", mappedBy="review", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $answers;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Shipment", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Exclude()
     */
    private $shipment;

    public function __construct(){
        $this->createdAt = new \DateTime();
        $this->answers = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|QAReviewAnswer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(QAReviewAnswer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setReview($this);
        }

        return $this;
    }

    public function removeAnswer(QAReviewAnswer $answer): self
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
            // set the owning side to null (unless already changed)
            if ($answer->getReview() === $this) {
                $answer->setReview(null);
            }
        }

        return $this;
    }

    public function getShipment(): ?Shipment
    {
        return $this->shipment;
    }

    public function setShipment(Shipment $shipment): self
    {
        $this->shipment = $shipment;

        return $this;
    }


}
