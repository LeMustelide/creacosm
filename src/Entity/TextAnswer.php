<?php

namespace App\Entity;

use App\Repository\TextAnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TextAnswerRepository::class)]
class TextAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2048)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'textAnswers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?QuestionText $question = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getQuestion(): ?QuestionText
    {
        return $this->question;
    }

    public function setQuestion(?QuestionText $question): self
    {
        $this->question = $question;

        return $this;
    }
}
