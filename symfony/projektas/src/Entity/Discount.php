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
     * @ORM\OnetoOne(targetEntity="App\Entity\Reservation", mappedBy="reservation")
     */
    private $reservation;

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
    public function getReservation()
    {
        return $this->reservation;
    }
    public function setReservation($reservation)
    {
        $this->reservation = $reservation;
    }

}
