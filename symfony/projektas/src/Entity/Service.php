<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="services")
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @ORM\Column(name="price", type="decimal", nullable=false)
     */
    private $price;
    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     * @Assert\Type("string")
     */
    private $name;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Reservation", mappedBy="services")
     * @ORM\JoinColumn(name="reservation_id", referencedColumnName="id")
     */
    private $reservations;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hotel", inversedBy="services")
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
    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getReservations()
    {
        return $this->reservations;
    }
    public function addReservation(Reservation $Reservation)
    {
        $this->reservations->add($Reservation);
    }
    public function getHotel()
    {
        return $this->hotel;
    }
    /**
     * @param string $hotel
     */
    public function setHotel($hotel)
    {
        $this->hotel = $hotel;
    }
}
