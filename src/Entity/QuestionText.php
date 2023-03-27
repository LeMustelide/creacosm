<?php

namespace App\Entity;

use App\Repository\QuestionTextRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionTextRepository::class)]
class QuestionText
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $entitled = null;

    #[ORM\Column]
    private ?int $minCharacterLimit = null;

    #[ORM\Column]
    private ?int $maxCharacterLimit = null;

    #[ORM\ManyToMany(targetEntity: Poll::class, inversedBy: 'questionsText')]
    private Collection $poll;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: TextAnswer::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $textAnswers;

    public function __construct()
    {
        $this->poll = new ArrayCollection();
        $this->textAnswers = new ArrayCollection();
    }

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

    public function getMinCharacterLimit(): ?int
    {
        return $this->minCharacterLimit;
    }

    public function setMinCharacterLimit(int $minCharacterLimit): self
    {
        $this->minCharacterLimit = $minCharacterLimit;

        return $this;
    }

    public function getMaxCharacterLimit(): ?int
    {
        return $this->maxCharacterLimit;
    }

    public function setMaxCharacterLimit(int $maxCharacterLimit): self
    {
        $this->maxCharacterLimit = $maxCharacterLimit;

        return $this;
    }

    /**
     * @return Collection<int, Poll>
     */
    public function getPoll(): Collection
    {
        return $this->poll;
    }

    public function addPoll(Poll $poll): self
    {
        if (!$this->poll->contains($poll)) {
            $this->poll->add($poll);
        }

        return $this;
    }

    public function removePoll(Poll $poll): self
    {
        $this->poll->removeElement($poll);

        return $this;
    }

    /**
     * @return Collection<int, TextAnswer>
     */
    public function getTextAnswers(): Collection
    {
        return $this->textAnswers;
    }

    public function addTextAnswer(TextAnswer $textAnswer): self
    {
        if (!$this->textAnswers->contains($textAnswer)) {
            $this->textAnswers->add($textAnswer);
            $textAnswer->setQuestion($this);
        }

        return $this;
    }

    public function removeTextAnswer(TextAnswer $textAnswer): self
    {
        if ($this->textAnswers->removeElement($textAnswer)) {
            // set the owning side to null (unless already changed)
            if ($textAnswer->getQuestion() === $this) {
                $textAnswer->setQuestion(null);
            }
        }

        return $this;
    }
}
