<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PreferencialWelcomeRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PreferencialWelcomeRepository::class)
 */
class PreferencialWelcome
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("orga")
     * @ORM\Column(type="string", length=255)
     */
    private $value;

    /**
     * 
     * @ORM\ManyToOne(targetEntity=Organization::class, inversedBy="preferencialWelcomes")
     */
    private $organisation_id;

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

    public function getOrganisationId(): ?Organization
    {
        return $this->organisation_id;
    }

    public function setOrganisationId(?Organization $organisation_id): self
    {
        $this->organisation_id = $organisation_id;

        return $this;
    }
}
