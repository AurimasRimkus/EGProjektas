<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Table(name="Users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @ORM\Column(name="email", type="string", nullable=false)
     */
    private $email;
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
    public function __construct()
    {
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function getUsername(): ?string
    {
        return $this->email;
    }
    public function setUsername(string $username)
    {
        $this->email = $username;
    }
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    /**
     * Returns employee type.
     * 1 if client account, 2 if employee account, 0 if error.
     * @return int
     */
    public function getUserType() 
    {
        if(!empty($this->clientAccount)) {
            return 1;
        } else if (!empty($this->employeeAccount)) {
            return 2;
        } else {
            return 0;
        }
    }

    public function getEmployeeAccount() {
        return $this->employeeAccount;
    }

    public function setEmployeeAccount($employeeAccount) {
        if(empty($this->clientAccount)) {
            $this->employeeAccount = $employeeAccount;
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
        } else {
            throw new \Exception('This is a employee account, can\'t assign client\'s account');
        }
    }

        public function getRoles()
    {
        return array ('ROLE_USER');
    }
    public function eraseCredentials()
    {
    }
}