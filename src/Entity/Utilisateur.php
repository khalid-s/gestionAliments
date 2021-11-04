<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @UniqueEntity(fields={"username"}, message = "Le user existe déjà")
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, max=10, minMessage="il faut plus de caractères", maxMessage="il faut moins de 10 caractères")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, max=10, minMessage="il faut plus de caractères", maxMessage="il faut moins de 10 caractères")
     */
    private $password;

    /**
     * @Assert\Length(min=5, max=10, minMessage="il faut plus de caractères", maxMessage="il faut moins de 10 caractères")
     * @Assert\EqualTo(propertyPath="password", message="les mdp ne sont pas égaux")
     */
    private $verificationPassword;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $roles;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getVerificationPassword(): ?string
    {

        return $this->verificationPassword;
    }

    public function setVerificationPassword(string $verificationPassword)
    {

        return $this->verificationPassword = $verificationPassword;
    }

    public function eraseCredentials()
    {
        
    }

    public function getSalt()
    {
        
    }

    public function getUserIdentifier()
    {
        
    }

    public function getRoles()
    {
        return [$this->roles];
    }

    public function setRoles(?string $roles): self
    {
        if($roles === null) {
            $this->roles = "ROLE_USER";
        } else {
            $this->roles = $roles;
        }
    
        return $this;
	}

}
