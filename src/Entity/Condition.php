<?php

namespace App\Entity;

use App\Repository\ConditionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConditionRepository::class)]
class Condition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $inversion = null;

    #[ORM\ManyToOne]
    private ?QuestionText $questionText = null;

    #[ORM\ManyToOne]
    private ?QuestionNumber $questionNumber = null;

    #[ORM\ManyToOne]
    private ?QuestionMCQMultiple $questionMCQMultiple = null;

    #[ORM\ManyToOne]
    private ?QuestionMCQSingle $questionMCQSingle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isInversion(): ?bool
    {
        return $this->inversion;
    }

    public function setInversion(?bool $inversion): self
    {
        $this->inversion = $inversion;

        return $this;
    }

    public function getQuestionText(): ?QuestionText
    {
        return $this->questionText;
    }

    public function setQuestionText(?QuestionText $questionText): self
    {
        $this->questionText = $questionText;

        return $this;
    }

    public function getQuestionNumber(): ?QuestionNumber
    {
        return $this->questionNumber;
    }

    public function setQuestionNumber(?QuestionNumber $questionNumber): self
    {
        $this->questionNumber = $questionNumber;

        return $this;
    }

    public function getQuestionMCQMultiple(): ?QuestionMCQMultiple
    {
        return $this->questionMCQMultiple;
    }

    public function setQuestionMCQMultiple(?QuestionMCQMultiple $questionMCQMultiple): self
    {
        $this->questionMCQMultiple = $questionMCQMultiple;

        return $this;
    }

    public function getQuestionMCQSingle(): ?QuestionMCQSingle
    {
        return $this->questionMCQSingle;
    }

    public function setQuestionMCQSingle(?QuestionMCQSingle $questionMCQSingle): self
    {
        $this->questionMCQSingle = $questionMCQSingle;

        return $this;
    }
}
