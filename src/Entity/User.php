<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(unique=true)
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $email;

    /**
     *
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;


    /**
     *  @ORM\Column(type="simple_array")
     */
    private $roles =[];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Conference", mappedBy="user")
     */
    private $conferences;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->roles = array('ROLE_USER');
    }

    /**
     * @return Collection|Conference[]
     */
    public function getConference(): Collection
    {
        return $this->conferences;
    }

    public function addConference(Conference $conference): self
    {
        if (!$this->conferences->contains($conference)) {
            $this->conferences[] = $conference;
            $conference->setUser($this);
        }
        return $this;
    }
    public function removeConference(Conference $conference): self
    {
        if ($this->conferences->contains($conference)) {
            $this->conferences->removeElement($conference);
            // set the owning side to null (unless already changed)
            if ($conference->getUser() === $this) {
                $conference->setUser(null);
            }
        }
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function setPassword(string $password):void
    {
        $this->password = $password;
    }
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }
    public  function getRoles()
    {
        return $this->roles;
    }

    public  function  setRoles($roles)
    {
        $this->roles =$roles;
        return $this;
    }

    public function getSalt() :string
    {
        return null;
    }

    public function getUsername():string
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     */
    public function eraseCredentials(): void
    {

    }



}
