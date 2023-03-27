<?php

namespace App\Entity;

use App\Repository\ConditionTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConditionTypeRepository::class)]
class ConditionType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $questionConstraint = null;

    #[ORM\Column(length: 255)]
    private ?string $questionType = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getQuestionConstraint(): ?string
    {
        return $this->questionConstraint;
    }

    public function setQuestionConstraint(string $questionConstraint): self
    {
        $this->questionConstraint = $questionConstraint;

        return $this;
    }

    public function getQuestionType(): ?string
    {
        return $this->questionType;
    }

    public function setQuestionType(string $questionType): self
    {
        $this->questionType = $questionType;

        return $this;
    }
}
