<?php
namespace App\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="Šis e-mail adresas jau užimtas..")
 * @UniqueEntity(fields={"username"}, message="Šis vartotojo vardas jau užimtas.")
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
     * @ORM\Column(name="username", type="string", length=255, nullable=false, unique=true)
     * @Assert\Type("string")
     */
    private $username;
    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Assert\Type("string")
     */
    private $name;
    /**
     * @ORM\Column(name="surname", type="string", length=255, nullable=false)
     * @Assert\Type("string")
     */
    private $surname;
    /**
     * @ORM\Column(name="personalCode", type="string", length=255, nullable=false, unique=true)
     * @Assert\Type("string")
     */
    private $personalCode;
    /**
     * @ORM\Column(name="email", type="string", length=255, nullable=false, unique=true)
     * @Assert\Email()
     */
    private $email;
    /**
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     * @Assert\Length(
     *     min=6,
     *     minMessage = "Password must be at least {{ limit }} characters long"
     * )
     */
    private $password;
    /**
     * @Assert\Length(
     *     min=6,
     *     minMessage = "New password must be at least {{ limit }} characters long"
     * )
     */
    private $newPassword;
    // Role 1 = user; 2 = mechanic; 3 = admin
    /**
     * @ORM\Column(name="role", type="integer", nullable=false)
     * @Assert\Range(
     *     min = 1,
     *     max = 3
     * )
     */
    private $role;
    /**
     * @ORM\Column(name="registrationDate", type="datetime", nullable=false)
     * @Assert\DateTime()
     */
    private $registrationDate;
    /**
     * @ORM\Column(name="lastLoginTime", type="datetime", nullable=false)
     * @Assert\DateTime()
     */
    private $lastLoginTime;
    /**
     * @ORM\Column(name="salary", type="integer", nullable=false)
     * @Assert\Type("int")
     */
    private $salary;
    /**
     * @ORM\Column(name="bankAccount", type="string", length=255, nullable=false, unique=true)
     * @Assert\Type("string")
     */
    private $bankAccount;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }
    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }
    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }
    /**
     * @param string $surname
     */
    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }
    /**
     * @return string
     */
    public function getPersonalCode()
    {
        return $this->personalCode;
    }
    /**
     * @param string $personalCode
     */
    public function setPersonalCode(string $personalCode)
    {
        $this->personalCode = $personalCode;
    }
    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }
    /**
     * @return string
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }
    /**
     * @param string $newPassword
     */
    public function setNewPassword(string $newPassword)
    {
        $this->newPassword = $newPassword;
    }
    /**
     * @return int
     */
    public function getRole()
    {
        return $this->role;
    }
    /**
     * @param int $role
     */
    public function setRole(int $role)
    {
        $this->role = $role;
    }
    /**
     * @return \DateTime
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }
    /**
     * @param \DateTime $registrationDate
     */
    public function setRegistrationDate(\DateTime $registrationDate)
    {
        $this->registrationDate = $registrationDate;
    }
    /**
     * @return \DateTime
     */
    public function getLastLoginTime()
    {
        return $this->lastLoginTime;
    }
    /**
     * @param \DateTime $lastLoginTime
     */
    public function setLastLoginTime(\DateTime $lastLoginTime)
    {
        $this->lastLoginTime = $lastLoginTime;
    }
    /**
     * @return int
     */
    public function getSalary()
    {
        return $this->salary;
    }
    /**
     * @param int $salary
     */
    public function setSalary(int $salary)
    {
        $this->salary = $salary;
    }
    /**
     * @return string
     */
    public function getBankAccount()
    {
        return $this->bankAccount;
    }
    /**
     * @param string $bankAccount
     */
    public function setBankAccount(string $bankAccount)
    {
        $this->bankAccount = $bankAccount;
    }
    public function getSalt()
    {
        return null;
    }
    public function getRoles()
    {
        return array ('ROLE_USER');
    }
    public function eraseCredentials()
    {
    }
}