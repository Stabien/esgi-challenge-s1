<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $credit_card_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $credit_card_expiration = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $credit_card_secret = null;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: Bet::class)]
    private Collection $bets;

    #[ORM\Column]
    private ?int $role = null;

    public function __construct()
    {
        $this->bets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreditCardNumber(): ?string
    {
        return $this->credit_card_number;
    }

    public function setCreditCardNumber(?string $credit_card_number): self
    {
        $this->credit_card_number = $credit_card_number;

        return $this;
    }

    public function getCreditCardExpiration(): ?string
    {
        return $this->credit_card_expiration;
    }

    public function setCreditCardExpiration(?string $credit_card_expiration): self
    {
        $this->credit_card_expiration = $credit_card_expiration;

        return $this;
    }

    public function getCreditCardSecret(): ?string
    {
        return $this->credit_card_secret;
    }

    public function setCreditCardSecret(?string $credit_card_secret): self
    {
        $this->credit_card_secret = $credit_card_secret;

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
            $bet->setUserId($this);
        }

        return $this;
    }

    public function removeBet(Bet $bet): self
    {
        if ($this->bets->removeElement($bet)) {
            // set the owning side to null (unless already changed)
            if ($bet->getUserId() === $this) {
                $bet->setUserId(null);
            }
        }

        return $this;
    }

    public function getRole(): ?int
    {
        return $this->role;
    }

    public function setRole(int $role): self
    {
        $this->role = $role;

        return $this;
    }
}
