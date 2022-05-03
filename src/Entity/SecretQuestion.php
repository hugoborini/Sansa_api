<?php

namespace App\Entity;

use App\Repository\SecretQuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SecretQuestionRepository::class)
 */
class SecretQuestion
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
    private $value;

    /**
     * @ORM\OneToMany(targetEntity=FinalUser::class, mappedBy="secret_question")
     */
    private $finalUsers;

    public function __construct()
    {
        $this->finalUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Collection<int, FinalUser>
     */
    public function getFinalUsers(): Collection
    {
        return $this->finalUsers;
    }

    public function addFinalUser(FinalUser $finalUser): self
    {
        if (!$this->finalUsers->contains($finalUser)) {
            $this->finalUsers[] = $finalUser;
            $finalUser->setSecretQuestion($this);
        }

        return $this;
    }

    public function removeFinalUser(FinalUser $finalUser): self
    {
        if ($this->finalUsers->removeElement($finalUser)) {
            // set the owning side to null (unless already changed)
            if ($finalUser->getSecretQuestion() === $this) {
                $finalUser->setSecretQuestion(null);
            }
        }

        return $this;
    }
}
