<?php

namespace App\Entity;

use App\Repository\MatchsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchsRepository::class)]
class Matchs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $bestOf = null;

    #[ORM\Column]
    private ?float $teamOneRating = null;

    #[ORM\Column]
    private ?float $teamTwoRating = null;

    #[ORM\Column]
    private ?int $teamOneScore = null;

    #[ORM\Column]
    private ?int $teamTwoScore = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $teamOne = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $teamTwo = null;

    #[ORM\ManyToOne]
    private ?Team $teamWinner = null;

    #[ORM\ManyToOne(inversedBy: 'matchs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Competition $competition = null;

    #[ORM\OneToMany(mappedBy: 'match', targetEntity: Bet::class)]
    private Collection $bets;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(nullable: true)]
    private ?int $status = null;

    public function __construct()
    {
        $this->bets = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->teamOne . ' - ' . $this->teamTwo;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBestOf(): ?int
    {
        return $this->bestOf;
    }

    public function setBestOf(int $bestOf): self
    {
        $this->bestOf = $bestOf;

        return $this;
    }

    public function getTeamOneRating(): ?float
    {
        return $this->teamOneRating;
    }

    public function setTeamOneRating(float $teamOneRating): self
    {
        $this->teamOneRating = $teamOneRating;

        return $this;
    }

    public function getTeamTwoRating(): ?float
    {
        return $this->teamTwoRating;
    }

    public function setTeamTwoRating(float $teamTwoRating): self
    {
        $this->teamTwoRating = $teamTwoRating;

        return $this;
    }

    public function getTeamOneScore(): ?int
    {
        return $this->teamOneScore;
    }

    public function setTeamOneScore(int $teamOneScore): self
    {
        $this->teamOneScore = $teamOneScore;

        return $this;
    }

    public function getTeamTwoScore(): ?int
    {
        return $this->teamTwoScore;
    }

    public function setTeamTwoScore(int $teamTwoScore): self
    {
        $this->teamTwoScore = $teamTwoScore;

        return $this;
    }

    public function getTeamOne(): ?Team
    {
        return $this->teamOne;
    }

    public function setTeamOne(?Team $teamOne): self
    {
        $this->teamOne = $teamOne;

        return $this;
    }

    public function getTeamTwo(): ?Team
    {
        return $this->teamTwo;
    }

    public function setTeamTwo(?Team $teamTwo): self
    {
        $this->teamTwo = $teamTwo;

        return $this;
    }

    public function getTeamWinner(): ?Team
    {
        return $this->teamWinner;
    }

    public function setTeamWinner(?Team $teamWinner): self
    {
        $this->teamWinner = $teamWinner;

        return $this;
    }

    public function getCompetition(): ?Competition
    {
        return $this->competition;
    }

    public function setCompetition(?Competition $competition): self
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * @return Collection<int, Bet>
     */
    public function getBets(): Collection
    {
        return $this->bets;
    }

    public function addBet(Bet $bet): self
    {
        if (!$this->bets->contains($bet)) {
            $this->bets->add($bet);
            $bet->setMatch($this);
        }

        return $this;
    }

    public function removeBet(Bet $bet): self
    {
        if ($this->bets->removeElement($bet)) {
            // set the owning side to null (unless already changed)
            if ($bet->getMatch() === $this) {
                $bet->setMatch(null);
            }
        }

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
