<?php

namespace App\Entity;

use App\Repository\TextAnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'textAnswer', targetEntity: History::class)]
    private Collection $histories;

    public function __construct()
    {
        $this->histories = new ArrayCollection();
    }

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
            $history->setTextAnswer($this);
        }

        return $this;
    }

    public function removeHistory(History $history): self
    {
        if ($this->histories->removeElement($history)) {
            // set the owning side to null (unless already changed)
            if ($history->getTextAnswer() === $this) {
                $history->setTextAnswer(null);
            }
        }

        return $this;
    }
}
