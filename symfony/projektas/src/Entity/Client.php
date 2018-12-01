<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="clients")
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="employeeAccount")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     */
    private $User;
    /**
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;
    /**
     * @ORM\Column(name="surname", type="string", nullable=false)
     */
    private $surname;
    /**
     * @ORM\Column(name="personalCode", type="string", nullable=false)
     */
    private $personalCode;
    /**
     * @ORM\Column(name="creditCard", type="string", nullable=false)
     */
    private $creditCard;
    /**
     * @ORM\Column(name="phoneNumber", type="string", nullable=false)
     */
    private $phoneNumber;
    /**
     * @ORM\OneToMany(targetEntity="Reservation", mappedBy="client")
     */
    private $reservations;

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
    public function getUser()
    {
        return $this->User;
    }
    public function setUser($User)
    {
        $this->User = $User;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
    public function getPersonalCode()
    {
        return $this->personalCode;
    }
    public function setPersonalCode($personalCode)
    {
        $this->personalCode = $personalCode;
    }
    public function getCreditCard()
    {
        return $this->creditCard;
    }
    public function setCreditCard($creditCard)
    {
        $this->creditCard = $creditCard;
    }
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
    public function getReservations()
    {
        return $this->reservations;
    }
    public function setReservations($reservations)
    {
        $this->reservations = $reservations;
    }
}