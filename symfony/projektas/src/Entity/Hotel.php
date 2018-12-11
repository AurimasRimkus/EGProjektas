<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="hotels")
 * @ORM\Entity(repositoryClass="App\Repository\HotelRepository")
 */
class Hotel
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
     * @ORM\Column(name="companyCode", type="string", length=255, nullable=false, unique=true)
     * @Assert\Type("string")
     */
    private $companyCode;
    /**
     * @ORM\Column(name="rating", type="float", nullable=false)
     * @Assert\Type("float")
     */
    private $rating;
    /**
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     * @Assert\Type("string")
     */
    private $address;
	/**
     * @ORM\Column(name="website", type="string", length=255, nullable=false)
     * @Assert\Type("string")
     */
    private $website;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Warehouse", mappedBy="hotel")
     */
    private $warehouse;
     /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Room", mappedBy="hotel")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     */
    private $rooms;
     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Service", mappedBy="hotel")
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
    public function getCompanyCode()
    {
        return $this->companyCode;
    }
    /**
     * @param string $companyCode
     */
    public function setCompanyCode($companyCode)
    {
        $this->companyCode = $companyCode;
    }
    /**
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }
    /**
     * @param double $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
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
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }
    /**
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    public function getRooms()
    {
        return $this->rooms;
    }
    public function addRoom($room)
    {
        $this->rooms->add($room);
    }
}