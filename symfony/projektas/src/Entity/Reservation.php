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
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="reservations")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

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
}