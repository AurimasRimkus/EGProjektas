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
     * @ORM\Column(type="string", length=180, unique=true, name="email", nullable=false)
     */
    private $username;

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
     * @ORM\OneToOne(targetEntity="App\Entity\Client", mappedBy="User", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $clientAccount;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Employee", mappedBy="User", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $employeeAccount;
    public function __construct() {
        $this->clientAccount = new Client();
        $this->employeeAccount = new Employee();
    }
    public function getId(): ?int
    {
        return $this->id;
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

    public function isEmployee() 
    {
        return !empty($this->employeeAccount);
    }
    
    public function getEmployeeAccount() {
        if(empty($this->employeeAccount)) {
            $this->employeeAccount = new Employee();
        }
        return $this->employeeAccount;
    }

    public function setEmployeeAccount($employeeAccount) {
        if (empty($employeeAccount)) {
            $this->employeeAccount = new Employee();        
        } else {
            $this->employeeAccount = $employeeAccount;
        }
        $this->employeeAccount->setUser($this);
        $this->clientAccount = null;
        return $this;
    }

    public function getClientAccount() {
        if(empty($this->clientAccount)) { 
            $this->clientAccount = new Client();
        }
        return $this->clientAccount;
    }

    public function setClientAccount($clientAccount) {
        if (empty($clientAccount)) {
            $this->clientAccount = new Client(); 
        } else {
            $this->clientAccount = $clientAccount;
        }
        $this->clientAccount->setUser($this);
        $this->employeeAccount = null;
        return $this;
    }
}
