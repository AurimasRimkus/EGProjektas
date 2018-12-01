<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="hotelNetworkReports")
 * @ORM\Entity(repositoryClass="App\Repository\HotelNetworkReportRepository")
 */
class HotelNetworkReport
{
    /**
     * @ORM\Column(name="id", type="int", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @ORM\Column(name="reportDate", type="datetime", nullable=false)
     * @Assert\DateTime()
     */
    private $reportDate;
    /**
     * @ORM\Column(name="comment", type="string", length=255)
     * @Assert\Type("string")
     */
    private $comment;
    /**
     * @ORM\Column(name="hotel", type="string", length=255, nullable=false)
     * @Assert\Type("int")
     */
    private $hotel;
    /**
     * @ORM\Column(name="price", type="integer", nullable=false)
     * @Assert\Type("int")
     */
    private $price;
    /**
     * @ORM\Column(name="userId", type="integer", nullable=false)
     * @Assert\Type("int")
     */
    private $userId;

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
    public function getHotel()
    {
        return $this->hotel;
    }
    public function setHotel($hotel)
    {
        $this->hotel = $hotel;
    }
    public function getReportDate(): ?DateTime
    {
        return $this->reportDate;
    }
    public function setReportDate(string $reportDate): self
    {
        $this->reportDate = $reportDate;
    }
    public function getComment(): ?string
    {
        return $this->comment;
    }
    public function setComment(string $comment): self
    {
        $this->comment = $comment;
    }
    public function getUserId()
    {
        return $this->userId;
    }
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}