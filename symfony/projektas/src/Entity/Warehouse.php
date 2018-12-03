<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="warehouses")
 * @ORM\Entity(repositoryClass="App\Repository\WarehouseRepository")
 */
class Warehouse
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="warehouse")
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Item", mappedBy="warehouse")
     */
    private $items;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Hotel", inversedBy="warehouse")
     * @ORM\JoinColumn(name="hotel_id", referencedColumnName="id")
     */
    private $hotel;

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
    /**
     * @return Collection|Orders[]
     */
    public function getOrders()
    {
        return $this->orders;
    }
    public function addOrder(Order $order)
    {
        $this->orders->add($order);
    }

}
