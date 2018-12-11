<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="reviews")
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 */
class Review
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @ORM\Column(name="rating", type="integer", nullable=false)
     * @Assert\Range(
     *     min = 1,
     *     max = 10
     * )
     */
    private $rating;
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
    public function getRating()
    {
        return $this->rating;
    }
    /**
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
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
