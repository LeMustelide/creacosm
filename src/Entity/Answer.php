<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToMany(targetEntity: History::class, mappedBy: 'answer')]
    private Collection $histories;

    public function __construct()
    {
        $this->histories = new ArrayCollection();
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

    /**
     * @return Collection<int, History>
     */
    public function getHistories(): Collection
    {
        return $this->histories;
    }

    public function addHistory(History $history): self
    {
        if (!$this->histories->contains($history)) {
            $this->histories->add($history);
            $history->addAnswer($this);
        }

        return $this;
    }

    public function removeHistory(History $history): self
    {
        if ($this->histories->removeElement($history)) {
            $history->removeAnswer($this);
        }

        return $this;
    }
}
