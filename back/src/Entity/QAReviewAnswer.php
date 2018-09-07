<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QAReviewAnswerRepository")
 */
class QAReviewAnswer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rating;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QAReview", inversedBy="answers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $review;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QAQuestion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getReview(): ?QAReview
    {
        return $this->review;
    }

    public function setReview(?QAReview $review): self
    {
        $this->review = $review;

        return $this;
    }

    public function getQuestion(): ?QAQuestion
    {
        return $this->question;
    }

    public function setQuestion(?QAQuestion $question): self
    {
        $this->question = $question;

        return $this;
    }
}
