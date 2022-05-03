<?php

namespace App\Entity;

use App\Repository\FinalUserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FinalUserRepository::class)
 */
class FinalUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $favorites = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secret_answer;

    /**
     * @ORM\ManyToOne(targetEntity=SecretQuestion::class, inversedBy="finalUsers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $secret_question;

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

    public function getFavorites(): ?array
    {
        return $this->favorites;
    }

    public function setFavorites(?array $favorites): self
    {
        $this->favorites = $favorites;

        return $this;
    }

    public function getSecretAnswer(): ?string
    {
        return $this->secret_answer;
    }

    public function setSecretAnswer(string $secret_answer): self
    {
        $this->secret_answer = $secret_answer;

        return $this;
    }

    public function getSecretQuestion(): ?SecretQuestion
    {
        return $this->secret_question;
    }

    public function setSecretQuestion(?SecretQuestion $secret_question): self
    {
        $this->secret_question = $secret_question;

        return $this;
    }
}
