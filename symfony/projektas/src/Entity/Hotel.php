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
     * @ORM\Column(name="rating", type="double", nullable=false)
     * @Assert\Type("double")
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
    public function __construct()
    {
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
}