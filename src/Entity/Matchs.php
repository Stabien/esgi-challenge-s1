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

    #[ORM\Column(type: Types::GUID)]
    private ?string $uuid = null;

    #[ORM\Column]
    private ?int $best_of = null;

    #[ORM\ManyToOne(inversedBy: 'matchs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?team $team_one_uuid = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?team $team_two_uuid = null;

    #[ORM\Column]
    private ?float $team_one_rating = null;

    #[ORM\Column]
    private ?float $team_two_rating = null;

    #[ORM\Column]
    private ?int $team_one_score = null;

    #[ORM\Column]
    private ?int $team_two_score = null;

    #[ORM\ManyToOne]
    private ?Team $team_winner_uuid = null;

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

    public function getBestOf(): ?int
    {
        return $this->best_of;
    }

    public function setBestOf(int $best_of): self
    {
        $this->best_of = $best_of;

        return $this;
    }

    public function getTeamOneUuid(): ?team
    {
        return $this->team_one_uuid;
    }

    public function setTeamOneUuid(?team $team_one_uuid): self
    {
        $this->team_one_uuid = $team_one_uuid;

        return $this;
    }

    public function getTeamTwoUuid(): ?team
    {
        return $this->team_two_uuid;
    }

    public function setTeamTwoUuid(?team $team_two_uuid): self
    {
        $this->team_two_uuid = $team_two_uuid;

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

    public function getTeamWinnerUuid(): ?Team
    {
        return $this->team_winner_uuid;
    }

    public function setTeamWinnerUuid(?Team $team_winner_uuid): self
    {
        $this->team_winner_uuid = $team_winner_uuid;

        return $this;
    }
}
