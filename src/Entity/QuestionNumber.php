<?php

namespace App\Entity;

use App\Repository\QuestionNumberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionNumberRepository::class)]
class QuestionNumber
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $entitled = null;

    #[ORM\Column]
    private ?float $nbStart = null;

    #[ORM\Column]
    private ?float $nbEnd = null;

    #[ORM\Column]
    private ?float $step = null;

    #[ORM\ManyToMany(targetEntity: Poll::class, inversedBy: 'questionsNumber')]
    private Collection $poll;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: NumberAnswer::class, orphanRemoval: true)]
    private Collection $numberAnswers;

    public function __construct()
    {
        $this->poll = new ArrayCollection();
        $this->numberAnswers = new ArrayCollection();
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

    public function getNbStart(): ?float
    {
        return $this->nbStart;
    }

    public function setNbStart(float $nbStart): self
    {
        $this->nbStart = $nbStart;

        return $this;
    }

    public function getNbEnd(): ?float
    {
        return $this->nbEnd;
    }

    public function setNbEnd(float $nbEnd): self
    {
        $this->nbEnd = $nbEnd;

        return $this;
    }

    public function getStep(): ?float
    {
        return $this->step;
    }

    public function setStep(float $step): self
    {
        $this->step = $step;

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
     * @return Collection<int, NumberAnswer>
     */
    public function getNumberAnswers(): Collection
    {
        return $this->numberAnswers;
    }

    public function addNumberAnswer(NumberAnswer $numberAnswer): self
    {
        if (!$this->numberAnswers->contains($numberAnswer)) {
            $this->numberAnswers->add($numberAnswer);
            $numberAnswer->setQuestion($this);
        }

        return $this;
    }

    public function removeNumberAnswer(NumberAnswer $numberAnswer): self
    {
        if ($this->numberAnswers->removeElement($numberAnswer)) {
            // set the owning side to null (unless already changed)
            if ($numberAnswer->getQuestion() === $this) {
                $numberAnswer->setQuestion(null);
            }
        }

        return $this;
    }
}
