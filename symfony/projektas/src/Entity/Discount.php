<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="discounts")
 * @ORM\Entity(repositoryClass="App\Repository\DiscountRepository")
 */
class Discount
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @ORM\Column(name="value", type="decimal", nullable=false)
     * @Assert\Range(
     *     min = 1,
     *     max = 50
     * )
     */
    private $value;
    /**
     * @ORM\Column(name="code", type="string", nullable=false)
     */
    private $code;
    /**
     * @ORM\OnetoMany(targetEntity="App\Entity\Reservation", mappedBy="discount")
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
    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }
    /**
     * @param int $rating
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getCode()
    {
        return $this->code;
    }
    /**
     * @param int $rating
     */
    public function setCode($code)
    {
        $this->code = $code;
    }
    public function getReservations()
    {
        return $this->reservations;
    }
    public function setReservations($reservations)
    {
        $this->reservations = $reservations;
    }
    public function addReservation($reservation)
    {
        $this->reservations[] = $reservation;
    }

    public function removeReservation($reservation)
    {
        $this->reservations->remove($reservation);
    }
}
