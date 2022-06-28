<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\OrganizationOwner;
use Doctrine\Common\Collections\Collection;
use App\Repository\OrganizationOwnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=OrganizationOwnerRepository::class)
 */
class OrganizationOwner implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("orga")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Organization::class, mappedBy="organization_owner")
     * 
     */
    private $oraganization;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tel;

    public function eraseCredentials() {}
    public function getSalt(){}
    public function getRoles(){
        return ["ROLE_ADMIN"];
    }
    
    
    public function __construct()
    {
        $this->organization_name = new ArrayCollection();
        $this->oraganization = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getEmail(): ?string
    {
        return $this->email;
    }
    
    public function getUsername():string{
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

    /**
     * @return Collection<int, Organization>
     */
    public function getOraganization(): Collection
    {
        return $this->oraganization;
    }

    public function addOraganization(Organization $oraganization): self
    {
        if (!$this->oraganization->contains($oraganization)) {
            $this->oraganization[] = $oraganization;
            $oraganization->setOrganizationOwner($this);
        }

        return $this;
    }

    public function removeOraganization(Organization $oraganization): self
    {
        if ($this->oraganization->removeElement($oraganization)) {
            // set the owning side to null (unless already changed)
            if ($oraganization->getOrganizationOwner() === $this) {
                $oraganization->setOrganizationOwner(null);
            }
        }

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }
}
