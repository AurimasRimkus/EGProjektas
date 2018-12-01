<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="cars")
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Employee
{
    /**
     * @ORM\Column(type="int", nullable=false)
     * @ORM\Id
     */
    private $userId;
    /**
     * @ORM\Column(type="int", nullable=false)
     */
    private $employeeType;
    public function __construct()
    {
    }
    public function getUserId()
    {
        return $this->userId;
    }
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    public function getEmployeeType(): ?int
    {
        return $this->employeeType;
    }
    public function setEmployeeType(string $employeeType): self
    {
        $this->employeeType = $employeeType;
    }
}