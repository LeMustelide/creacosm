<?php

namespace App\Entity;

use App\Repository\NumberAnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NumberAnswerRepository::class)]
class NumberAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $value = null;

    #[ORM\ManyToOne(inversedBy: 'numberAnswers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?QuestionNumber $question = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getQuestion(): ?QuestionNumber
    {
        return $this->question;
    }

    public function setQuestion(?QuestionNumber $question): self
    {
        $this->question = $question;

        return $this;
    }
}
