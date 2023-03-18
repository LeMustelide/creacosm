<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $entitled = null;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    private ?QuestionMCQMultiple $questionMultiple = null;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    private ?QuestionMCQSingle $questionSingle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntitled(): ?string
    {
        return $this->entitled;
    }

    public function setEntitled(string $entitled): self
    {
        $this->entitled = $entitled;

        return $this;
    }

    public function getQuestionMultiple(): ?QuestionMCQMultiple
    {
        return $this->questionMultiple;
    }

    public function setQuestionMultiple(?QuestionMCQMultiple $questionMultiple): self
    {
        $this->questionMultiple = $questionMultiple;

        return $this;
    }

    public function getQuestionSingle(): ?QuestionMCQSingle
    {
        return $this->questionSingle;
    }

    public function setQuestionSingle(?QuestionMCQSingle $questionSingle): self
    {
        $this->questionSingle = $questionSingle;

        return $this;
    }
}
