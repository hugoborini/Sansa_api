<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\OrganizationRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=OrganizationRepository::class)
 */
class Organization
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("orga")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=OrganizationOwner::class, inversedBy="oraganization")
     * @Groups("orga")
     */
    private $organization_owner;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("orga")
     * @Groups("orgaByService")
     */
    private $organization_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("orga")
     * @Groups("orgaByService")
     */
    private $adress;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("orga")
     * @Groups("orgaByService")
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     * @Groups("orga")
     * @Groups("orgaByService")
     */
    private $last_updata;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("orga")
     * @Groups("orgaByService")
     */
    private $phone_number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("orga")
     * @Groups("orgaByService")
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("orga")
     * @Groups("orgaByService")
     */
    private $spoken_language;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("orga")
     * @Groups("orgaByService")
     */
    private $importante_information;

    /**
     * @ORM\OneToMany(targetEntity=Services::class, mappedBy="organization_id")
     * 
     */
    private $organization_id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("orgaByService")
     * @Groups("orga")
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("orgaByService")
     * @Groups("orga")
     */
    private $latitude;

    /**
     * @ORM\OneToMany(targetEntity=Services::class, mappedBy="organization_id")
     * @Groups("orga")
     * 
     */
    private $services_id;

    /**
     * @ORM\OneToMany(targetEntity=Hours::class, mappedBy="organization_id")
     * @Groups("orga")
     * @Groups("orgaByService")
     */
    private $hours_id;

    public function __construct()
    {
        $this->organization_id = new ArrayCollection();
        $this->services_id = new ArrayCollection();
        $this->hours_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrganizationOwner(): ?OrganizationOwner
    {
        return $this->organization_owner;
    }

    public function setOrganizationOwner(?OrganizationOwner $organization_owner): self
    {
        $this->organization_owner = $organization_owner;

        return $this;
    }

    public function getOrganizationName(): ?string
    {
        return $this->organization_name;
    }

    public function setOrganizationName(?string $organization_name): self
    {
        $this->organization_name = $organization_name;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLastUpdata(): ?\DateTimeInterface
    {
        return $this->last_updata;
    }

    public function setLastUpdata(\DateTimeInterface $last_updata): self
    {
        $this->last_updata = $last_updata;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getSpokenLanguage(): ?string
    {
        return $this->spoken_language;
    }

    public function setSpokenLanguage(?string $spoken_language): self
    {
        $this->spoken_language = $spoken_language;

        return $this;
    }

    public function getImportanteInformation(): ?string
    {
        return $this->importante_information;
    }

    public function setImportanteInformation(string $importante_information): self
    {
        $this->importante_information = $importante_information;

        return $this;
    }

    /**
     * @return Collection<int, Services>
     */
    public function getOrganizationId(): Collection
    {
        return $this->organization_id;
    }

    public function addOrganizationId(Services $organizationId): self
    {
        if (!$this->organization_id->contains($organizationId)) {
            $this->organization_id[] = $organizationId;
            $organizationId->setOrganizationId($this);
        }

        return $this;
    }

    public function removeOrganizationId(Services $organizationId): self
    {
        if ($this->organization_id->removeElement($organizationId)) {
            // set the owning side to null (unless already changed)
            if ($organizationId->getOrganizationId() === $this) {
                $organizationId->setOrganizationId(null);
            }
        }

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return Collection<int, Services>
     */
    public function getServicesId(): Collection
    {
        return $this->services_id;
    }

    public function addServicesId(Services $servicesId): self
    {
        if (!$this->services_id->contains($servicesId)) {
            $this->services_id[] = $servicesId;
            $servicesId->setOrganisationId($this);
        }

        return $this;
    }

    public function removeServicesId(Services $servicesId): self
    {
        if ($this->services_id->removeElement($servicesId)) {
            // set the owning side to null (unless already changed)
            if ($servicesId->getOrganisationId() === $this) {
                $servicesId->setOrganisationId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Hours>
     */
    public function getHoursId(): Collection
    {
        return $this->hours_id;
    }

    public function addHoursId(Hours $hoursId): self
    {
        if (!$this->hours_id->contains($hoursId)) {
            $this->hours_id[] = $hoursId;
            $hoursId->setOrganizationId($this);
        }

        return $this;
    }

    public function removeHoursId(Hours $hoursId): self
    {
        if ($this->hours_id->removeElement($hoursId)) {
            // set the owning side to null (unless already changed)
            if ($hoursId->getOrganizationId() === $this) {
                $hoursId->setOrganizationId(null);
            }
        }

        return $this;
    }
}
