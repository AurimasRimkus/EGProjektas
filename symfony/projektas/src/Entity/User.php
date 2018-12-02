<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="users")
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
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @Assert\NotBlank
     * @Assert\Length(max=4096)
     */
    private $plainPassword;
    /**
     * @ORM\Column(name="password", type="string", length=64, nullable=false)
     */
    private $password;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Client", mappedBy="User")
     */
    private $clientAccount;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Employee", mappedBy="User")
     */
    private $employeeAccount;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    
    public function getEmployeeAccount() {
        return $this->employeeAccount;
    }

    public function setEmployeeAccount($employeeAccount) {
        if(empty($this->clientAccount)) {
            $this->employeeAccount = $employeeAccount;
            return $this;
        } else {
            throw new \Exception('This is a client account, can\'t assign employee\'s account');
        }
    }

    public function getClientAccount() {
        return $this->clientAccount;
    }

    public function setClientAccount($clientAccount) {
        if(empty($this->employeeAccount)) {
            $this->clientAccount = $clientAccount;
            return $this;
        } else {
            throw new \Exception('This is a employee account, can\'t assign client\'s account');
        }
    }
}
