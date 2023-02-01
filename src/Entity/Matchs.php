<?php

namespace App\Entity;

use App\Repository\MatchsRepository;
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
    private ?int $best_of = null;

    #[ORM\Column]
    private ?float $team_one_rating = null;

    #[ORM\Column]
    private ?float $team_two_rating = null;

    #[ORM\Column]
    private ?int $team_one_score = null;

    #[ORM\Column]
    private ?int $team_two_score = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $team_one = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $team_two = null;

    #[ORM\ManyToOne]
    private ?Team $team_winner = null;

    #[ORM\ManyToOne(inversedBy: 'matchs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Competition $competition = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBestOf(): ?int
    {
        return $this->best_of;
    }

    public function setBestOf(int $best_of): self
    {
        $this->best_of = $best_of;

        return $this;
    }

    public function getTeamOneRating(): ?float
    {
        return $this->team_one_rating;
    }

    public function setTeamOneRating(float $team_one_rating): self
    {
        $this->team_one_rating = $team_one_rating;

        return $this;
    }

    public function getTeamTwoRating(): ?float
    {
        return $this->team_two_rating;
    }

    public function setTeamTwoRating(float $team_two_rating): self
    {
        $this->team_two_rating = $team_two_rating;

        return $this;
    }

    public function getTeamOneScore(): ?int
    {
        return $this->team_one_score;
    }

    public function setTeamOneScore(int $team_one_score): self
    {
        $this->team_one_score = $team_one_score;

        return $this;
    }

    public function getTeamTwoScore(): ?int
    {
        return $this->team_two_score;
    }

    public function setTeamTwoScore(int $team_two_score): self
    {
        $this->team_two_score = $team_two_score;

        return $this;
    }

    public function getTeamOne(): ?Team
    {
        return $this->team_one;
    }

    public function setTeamOne(?Team $team_one): self
    {
        $this->team_one = $team_one;

        return $this;
    }

    public function getTeamTwo(): ?Team
    {
        return $this->team_two;
    }

    public function setTeamTwo(?Team $team_two): self
    {
        $this->team_two = $team_two;

        return $this;
    }

    public function getTeamWinner(): ?Team
    {
        return $this->team_winner;
    }

    public function setTeamWinner(?Team $team_winner): self
    {
        $this->team_winner = $team_winner;

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
}
