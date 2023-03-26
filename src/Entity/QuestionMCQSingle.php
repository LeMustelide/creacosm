<?php

namespace App\Entity;

use App\Repository\QuestionMCQSingleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionMCQSingleRepository::class)]
class QuestionMCQSingle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $entitled = null;

    #[ORM\ManyToMany(targetEntity: Poll::class, inversedBy: 'questionsMCQSingle')]
    private Collection $poll;

    #[ORM\OneToMany(mappedBy: 'questionSingle', targetEntity: Answer::class, cascade: ['persist', 'remove'])]
    private Collection $answers;

    public function __construct()
    {
        $this->poll = new ArrayCollection();
        $this->answers = new ArrayCollection();
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
     * @return Collection<int, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setQuestionSingle($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestionSingle() === $this) {
                $answer->setQuestionSingle(null);
            }
        }

        return $this;
    }
}
