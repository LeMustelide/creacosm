<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 512)]
    private ?string $entitled = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    public function __construct(String $entitled, String $type)
    {
        $this->entitled = $entitled;
        $this->type = $type;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getentitled(): ?string
    {
        return $this->entitled;
    }

    public function setentitled(string $entitled): self
    {
        $this->entitled = $entitled;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
