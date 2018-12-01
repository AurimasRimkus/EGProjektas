<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="employees")
 * @ORM\Entity(repositoryClass="App\Repository\EmployeeRepository")
 */
class Employee
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="employeeAccount")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     */
    private $User;
    /**
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;
    /**
     * @ORM\Column(name="surname", type="string", nullable=false)
     */
    private $surname;
    /**
     * @ORM\Column(name="personalCode", type="string", nullable=false)
     */
    private $personalCode;
    /**
     * @ORM\Column(name="bankAccount", type="string", nullable=false)
     */
    private $bankAccount;
    /**
     * @ORM\Column(name="employeeType", type="integer", nullable=false)
     * @Assert\Range(
     *     min = 1,
     *     max = 4
     * )
     */
    private $employeeType;
    /**
     * @ORM\Column(name="salary", type="float", nullable=false)
     */
    private $salary;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DayReport", mappedBy="employee")
     */
    private $dayReports;

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
    public function getEmployeeType(): ?int
    {
        return $this->employeeType;
    }
    public function setEmployeeType(string $employeeType): self
    {
        $this->employeeType = $employeeType;
    }
}