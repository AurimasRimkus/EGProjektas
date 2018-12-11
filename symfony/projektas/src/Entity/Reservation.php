<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="reservations")
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @ORM\Column(name="start", type="datetime", nullable=false)
     */
    private $start;
    /**
     * @ORM\Column(name="end", type="datetime", nullable=false)
     */
    private $end;
    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="reservation")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Room", inversedBy="reservation")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     */
    private $room;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Review", inversedBy="reservation")
     * @ORM\JoinColumn(name="review_id", referencedColumnName="id")
     */
    private $review;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Discount", inversedBy="reservation")
     * @ORM\JoinColumn(name="discount_id", referencedColumnName="id")
     */
    private $discount;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Service", inversedBy="reservation")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     */
    private $services;

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
    public function getStart()
    {
        return $this->start;
    }
    public function setStart($start)
    {
        $this->start = $start;
    }
    public function getEnd()
    {
        return $this->end;
    }
    public function setEnd($end)
    {
        $this->end = $end;
    }
    public function getClient()
    {
        return $this->client;
    }
    public function setClient($client)
    {
        $this->client = $client;
    }

    public function getRoom()
    {
        return $this->room;
    }
    public function setRoom($room)
    {
        $this->room = $room;
    }

    public function getReview()
    {
        return $this->review;
    }
    public function setReview($review)
    {
        $this->review = $review;
    }

    public function getDiscount()
    {
        return $this->discount;
    }
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    public function getServices()
    {
        return $this->services;
    }

    public function getServiceNames()
    {
        $services = array();

        foreach ($this->services as $service)
        {
            $services[] = $service->getName();
        } 
        return $services;
    }

    public function setServices($services)
    {
        return $this->services = $services;
    }

    public function addService($service)
    {
        $this->services[] = $service;
    }

    public function removeService($service)
    {
        $this->services->remove($service);
    }
}