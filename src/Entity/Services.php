<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ServicesRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ServicesRepository::class)
 */
class Services
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * 
     * @ORM\Column(type="string", length=255)
     * @Groups("orga")
     * @Groups("orgaByService")
     * @Groups("allService")
     * 
     */
    private $service_name;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups("orga")
     */
    private $subscribe;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $by_appointement;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $service_description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $state_saturation;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="category_id")
     */
    private $category_id;

    /**
     * @ORM\ManyToOne(targetEntity=Organization::class, inversedBy="services_id")
     * @ORM\JoinColumn(nullable=True)
     * @Groups("orgaByService")
     */
    private $organization_id;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServiceName(): ?string
    {
        return $this->service_name;
    }

    public function setServiceName(string $service_name): self
    {
        $this->service_name = $service_name;

        return $this;
    }


    public function getSubscribe(): ?bool
    {
        return $this->subscribe;
    }

    public function setSubscribe(?bool $subscribe): self
    {
        $this->subscribe = $subscribe;

        return $this;
    }

    public function getByAppointement(): ?bool
    {
        return $this->by_appointement;
    }

    public function setByAppointement(?bool $by_appointement): self
    {
        $this->by_appointement = $by_appointement;

        return $this;
    }

    public function getServiceDescription(): ?string
    {
        return $this->service_description;
    }

    public function setServiceDescription(?string $service_description): self
    {
        $this->service_description = $service_description;

        return $this;
    }

    public function getStateSaturation(): ?int
    {
        return $this->state_saturation;
    }

    public function setStateSaturation(?int $state_saturation): self
    {
        $this->state_saturation = $state_saturation;

        return $this;
    }

    public function getCategoryId(): ?Category
    {
        return $this->category_id;
    }

    public function setCategoryId(?Category $category_id): self
    {
        $this->category_id = $category_id;

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
