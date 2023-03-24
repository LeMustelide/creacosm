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
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $limitDate = null;

    #[ORM\Column]
    private ?bool $public = null;

    #[ORM\ManyToMany(targetEntity: QuestionText::class, mappedBy: 'poll', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $questionsText;

    #[ORM\ManyToMany(targetEntity: QuestionNumber::class, mappedBy: 'poll', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $questionsNumber;

    #[ORM\ManyToMany(targetEntity: QuestionMCQMultiple::class, mappedBy: 'poll', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $questionsMCQMultiple;

    #[ORM\ManyToMany(targetEntity: QuestionMCQSingle::class, mappedBy: 'poll', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $questionsMCQSingle;

    #[ORM\OneToMany(mappedBy: 'poll', targetEntity: History::class, orphanRemoval: true)]
    private Collection $histories;

    public function __construct()
    {
        $this->questionsText = new ArrayCollection();
        $this->questionsNumber = new ArrayCollection();
        $this->questionsMCQMultiple = new ArrayCollection();
        $this->questionsMCQSingle = new ArrayCollection();
        $this->histories = new ArrayCollection();
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

    public function getdescription(): ?string
    {
        return $this->description;
    }

    public function setdescription(?string $description): self
    {
        $this->description = $description;

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

    public function getQuestions(): ?array
    {
        $questions = [];
        foreach ($this->questionsText as $questionText) {
            $questions[] = new question($questionText->getQuestion(), "Texte");
        }
        foreach ($this->questionsNumber as $questionNumber) {
            $questions[] = new question($questionNumber->getQuestion(), "Nombre");
        }
        foreach ($this->questionsMCQMultiple as $questionMCQMultiple) {
            $questions[] = new question($questionMCQMultiple->getQuestion(), "Choix multiple");
        }
        foreach ($this->questionsMCQSingle as $questionMCQSingle) {
            $questions[] = new question($questionMCQSingle->getQuestion(), "Choix unique");
        }
        return $questions;
    }

    public function setQuestions(array $questions): self
    {
        foreach ($questions as $question) {
            var_dump($question);
            switch ($question["type"]) {
                case "Texte":
                    $questionText = new QuestionText();
                    $questionText->setEntitled($question["entitled"]);
                    $this->addQuestionsText($questionText);
                    break;
                case "Nombre":
                    $questionNumber = new QuestionNumber();
                    $questionNumber->setEntitled($question["entitled"]);
                    $this->addQuestionsNumber($questionNumber);
                    break;
                case "Choix multiple":
                    $questionMCQMultiple = new QuestionMCQMultiple();
                    $questionMCQMultiple->setEntitled($question["entitled"]);
                    $this->addQuestionsMCQMultiple($questionMCQMultiple);
                    break;
                case "Choix unique":
                    $questionMCQSingle = new QuestionMCQSingle();
                    $questionMCQSingle->setEntitled($question["entitled"]);
                    $this->addQuestionsMCQSingle($questionMCQSingle);
                    break;
            }
        }
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
            $history->setPoll($this);
        }

        return $this;
    }

    public function removeHistory(History $history): self
    {
        if ($this->histories->removeElement($history)) {
            // set the owning side to null (unless already changed)
            if ($history->getPoll() === $this) {
                $history->setPoll(null);
            }
        }

        return $this;
    }
}
