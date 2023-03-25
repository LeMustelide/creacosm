<?php

namespace App\Entity;

use App\Repository\HistoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoryRepository::class)]
class History
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::GUID)]
    private ?string $uuid = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'histories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Poll $poll = null;

    #[ORM\ManyToOne(inversedBy: 'histories')]
    private ?TextAnswer $textAnswer = null;

    #[ORM\ManyToOne(inversedBy: 'histories')]
    private ?NumberAnswer $numberAnswer = null;

    #[ORM\ManyToMany(targetEntity: Answer::class, inversedBy: 'histories')]
    private Collection $answer;

    public function __construct()
    {
        $this->answer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPoll(): ?Poll
    {
        return $this->poll;
    }

    public function setPoll(?Poll $poll): self
    {
        $this->poll = $poll;

        return $this;
    }

    public function getTextAnswer(): ?TextAnswer
    {
        return $this->textAnswer;
    }

    public function setTextAnswer(?TextAnswer $textAnswer): self
    {
        $this->textAnswer = $textAnswer;

        return $this;
    }

    public function getNumberAnswer(): ?NumberAnswer
    {
        return $this->numberAnswer;
    }

    public function setNumberAnswer(?NumberAnswer $numberAnswer): self
    {
        $this->numberAnswer = $numberAnswer;

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswer(): Collection
    {
        return $this->answer;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answer->contains($answer)) {
            $this->answer->add($answer);
        }

        return $this;
    }

    public function setAnswer(Collection $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        $this->answer->removeElement($answer);

        return $this;
    }
}
