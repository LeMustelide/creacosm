<?php

namespace App\Entity;

use App\Repository\PollRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PollRepository::class)]
class Poll
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $dscription = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $limitDate = null;

    #[ORM\Column]
    private ?bool $public = null;

    #[ORM\ManyToMany(targetEntity: QuestionText::class, mappedBy: 'poll')]
    private Collection $questionsText;

    #[ORM\ManyToMany(targetEntity: QuestionNumber::class, mappedBy: 'poll')]
    private Collection $questionsNumber;

    #[ORM\ManyToMany(targetEntity: QuestionMCQMultiple::class, mappedBy: 'poll')]
    private Collection $questionsMCQMultiple;

    #[ORM\ManyToMany(targetEntity: QuestionMCQSingle::class, mappedBy: 'poll')]
    private Collection $questionsMCQSingle;

    public function __construct()
    {
        $this->questionsText = new ArrayCollection();
        $this->questionsNumber = new ArrayCollection();
        $this->questionsMCQMultiple = new ArrayCollection();
        $this->questionsMCQSingle = new ArrayCollection();
    }

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

    public function getDscription(): ?string
    {
        return $this->dscription;
    }

    public function setDscription(?string $dscription): self
    {
        $this->dscription = $dscription;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getLimitDate(): ?\DateTimeInterface
    {
        return $this->limitDate;
    }

    public function setLimitDate(?\DateTimeInterface $limitDate): self
    {
        $this->limitDate = $limitDate;

        return $this;
    }

    public function isPublic(): ?bool
    {
        return $this->public;
    }

    public function setPublic(bool $public): self
    {
        $this->public = $public;

        return $this;
    }

    /**
     * @return Collection<int, QuestionText>
     */
    public function getQuestionsText(): Collection
    {
        return $this->questionsText;
    }

    public function addQuestionsText(QuestionText $questionsText): self
    {
        if (!$this->questionsText->contains($questionsText)) {
            $this->questionsText->add($questionsText);
            $questionsText->addPoll($this);
        }

        return $this;
    }

    public function removeQuestionsText(QuestionText $questionsText): self
    {
        if ($this->questionsText->removeElement($questionsText)) {
            $questionsText->removePoll($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, QuestionNumber>
     */
    public function getQuestionsNumber(): Collection
    {
        return $this->questionsNumber;
    }

    public function addQuestionsNumber(QuestionNumber $questionsNumber): self
    {
        if (!$this->questionsNumber->contains($questionsNumber)) {
            $this->questionsNumber->add($questionsNumber);
            $questionsNumber->addPoll($this);
        }

        return $this;
    }

    public function removeQuestionsNumber(QuestionNumber $questionsNumber): self
    {
        if ($this->questionsNumber->removeElement($questionsNumber)) {
            $questionsNumber->removePoll($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, QuestionMCQMultiple>
     */
    public function getQuestionsMCQMultiple(): Collection
    {
        return $this->questionsMCQMultiple;
    }

    public function addQuestionsMCQMultiple(QuestionMCQMultiple $questionsMCQMultiple): self
    {
        if (!$this->questionsMCQMultiple->contains($questionsMCQMultiple)) {
            $this->questionsMCQMultiple->add($questionsMCQMultiple);
            $questionsMCQMultiple->addPoll($this);
        }

        return $this;
    }

    public function removeQuestionsMCQMultiple(QuestionMCQMultiple $questionsMCQMultiple): self
    {
        if ($this->questionsMCQMultiple->removeElement($questionsMCQMultiple)) {
            $questionsMCQMultiple->removePoll($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, QuestionMCQSingle>
     */
    public function getQuestionsMCQSingle(): Collection
    {
        return $this->questionsMCQSingle;
    }

    public function addQuestionsMCQSingle(QuestionMCQSingle $questionsMCQSingle): self
    {
        if (!$this->questionsMCQSingle->contains($questionsMCQSingle)) {
            $this->questionsMCQSingle->add($questionsMCQSingle);
            $questionsMCQSingle->addPoll($this);
        }

        return $this;
    }

    public function removeQuestionsMCQSingle(QuestionMCQSingle $questionsMCQSingle): self
    {
        if ($this->questionsMCQSingle->removeElement($questionsMCQSingle)) {
            $questionsMCQSingle->removePoll($this);
        }

        return $this;
    }
}
