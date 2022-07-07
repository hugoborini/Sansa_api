<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FinalUserRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=FinalUserRepository::class)
 */
class FinalUser implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * 
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

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user")
     */
    private $tel;

    /**
     * @ORM\Column(type="date")
     * @Groups("user")
     */
    private $date_incription;

    /**
     * @ORM\Column(type="date")
     * @Groups("user")
     */
    private $last_connection;

    public function eraseCredentials() {}
    public function getSalt(){}

    public function getRoles(){
        return ["ROLE_TEST"];
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

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getDateIncription(): ?\DateTimeInterface
    {
        return $this->date_incription;
    }

    public function setDateIncription(\DateTimeInterface $date_incription): self
    {
        $this->date_incription = $date_incription;

        return $this;
    }

    public function getLastConnection(): ?\DateTimeInterface
    {
        return $this->last_connection;
    }

    public function setLastConnection(\DateTimeInterface $last_connection): self
    {
        $this->last_connection = $last_connection;

        return $this;
    }
}
