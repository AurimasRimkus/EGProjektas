<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="hotels")
 * @ORM\Entity(repositoryClass="App\Repository\HotelRepository")
 */
class Warehouse
{
    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Assert\Type("string")
     */
    private $name;
    /**
     * @ORM\Column(name="adress", type="string", length=255, nullable=false, unique=true)
     * @Assert\Type("string")
     */
    private $address;
    /**
     * @ORM\Column(name="contactPerson", type="string", length=255, nullable=false, unique=true)
     * @Assert\Type("string")
     */
    private $contactPerson;

    public function __construct()
    {
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
    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * @return string
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }
    /**
     * @param string $contactPerson
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;
    }
    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

}