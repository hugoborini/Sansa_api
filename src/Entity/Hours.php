<?php

namespace App\Entity;

use App\Repository\HoursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=HoursRepository::class)
 */
class Hours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("orga")
     */
    private $monday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("orga")
     * @Groups("orgaByService")
     */
    private $tuesday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("orga")
     * @Groups("orgaByService")
     */
    private $wednesday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("orga")
     * @Groups("orgaByService")
     */
    private $thurday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("orga")
     * @Groups("orgaByService")
     */
    private $friday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("orga")
     * @Groups("orgaByService")
     */
    private $saturday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("orga")
     * @Groups("orgaByService")
     */
    private $sunday;

    /**
     * @ORM\ManyToOne(targetEntity=Organization::class, inversedBy="hours_id")
     * @ORM\JoinColumn(nullable=false)
     * 
     */
    private $organization_id;


    public function getId(): ?int
    {
        return $this->id;
    }



    public function getMonday(): ?string
    {
        return $this->monday;
    }

    public function setMonday(?string $monday): self
    {
        $this->monday = $monday;

        return $this;
    }

    public function getTuesday(): ?string
    {
        return $this->tuesday;
    }

    public function setTuesday(?string $tuesday): self
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    public function getWednesday(): ?string
    {
        return $this->wednesday;
    }

    public function setWednesday(?string $wednesday): self
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    public function getThurday(): ?string
    {
        return $this->thurday;
    }

    public function setThurday(?string $thurday): self
    {
        $this->thurday = $thurday;

        return $this;
    }

    public function getFriday(): ?string
    {
        return $this->friday;
    }

    public function setFriday(?string $friday): self
    {
        $this->friday = $friday;

        return $this;
    }

    public function getSaturday(): ?string
    {
        return $this->saturday;
    }

    public function setSaturday(?string $saturday): self
    {
        $this->saturday = $saturday;

        return $this;
    }

    public function getSunday(): ?string
    {
        return $this->sunday;
    }

    public function setSunday(?string $sunday): self
    {
        $this->sunday = $sunday;

        return $this;
    }

    public function getOrganizationId(): ?Organization
    {
        return $this->organization_id;
    }

    public function setOrganizationId(?Organization $organization_id): self
    {
        $this->organization_id = $organization_id;

        return $this;
    }
}
