<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="rooms")
 * @ORM\Entity(repositoryClass="App\Repository\RoomRepository")
 */
class Room
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @ORM\Column(name="status", type="integer", nullable=false)
     * @Assert\Range(
     *     min = 1,
     *     max = 4
     * )
     */
    private $status;
    /**
     * @ORM\Column(name="kaina", type="decimal", nullable=false)
     * @Assert\Range(
     *     min = 0
     * )
     */
    private $kaina;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="room")
     */
    private $reservations;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hotel", inversedBy="rooms")
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
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getKaina()
    {
        return $this->kaina;
    }
    public function setKaina($kaina)
    {
        $this->kaina = $kaina;
    }
    /**
     * @return Hotel
     */
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
    /**
     * @return Collection|Reservations[]
     */
    public function getReservations()
    {
        return $this->reservations;
    }
    public function addReservation(Reservation $Reservation)
    {
        $this->reservations->add($Reservation);
    }

}
