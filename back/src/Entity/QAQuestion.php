<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QAQuestionRepository")
 */
class QAQuestion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $question;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enableComment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enableRating;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getEnableComment(): ?bool
    {
        return $this->enableComment;
    }

    public function setEnableComment(bool $enableComment): self
    {
        $this->enableComment = $enableComment;

        return $this;
    }

    public function getEnableRating(): ?bool
    {
        return $this->enableRating;
    }

    public function setEnableRating(bool $enableRating): self
    {
        $this->enableRating = $enableRating;

        return $this;
    }
}
