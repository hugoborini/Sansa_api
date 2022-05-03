<?php

namespace App\Entity;

use App\Repository\HoursRepository;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OneToOne(targetEntity=Services::class, inversedBy="hours_id", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $service_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $monday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tuesday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wednesday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thurday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $friday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $saturday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sunday;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServiceId(): ?Services
    {
        return $this->service_id;
    }

    public function setServiceId(Services $service_id): self
    {
        $this->service_id = $service_id;

        return $this;
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
}
