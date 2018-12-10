<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="dayReports")
 * @ORM\Entity(repositoryClass="App\Repository\DayReportRepository")
 */
class DayReport
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
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
     * @ORM\Column(name="dayLength", type="integer", nullable=false)
     * @Assert\Type("integer")
     * @Assert\Range(
     *     min = 1,
     *     max = 480,
     *     minMessage = "Day must be at least 1 minute long",
     *     maxMessage = "Day length can't exceed 480 minutes"
     * )
     */
    private $dayLength;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employee", inversedBy="dayReports")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     */
    private $employee;

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
        return $this->id;
    }
    public function getReportDate(): ?DateTime
    {
        return $this->reportDate;
    }
    public function setReportDate(\DateTime $reportDate): self
    {
        $this->reportDate = $reportDate;
        return $this;
    }
    public function getComment(): ?string
    {
        return $this->comment;
    }
    public function setComment(string $comment): self
    {
        $this->comment = $comment;
        return $this;
    }
    public function getDayLength(): ?int
    {
        return $this->dayLength;
    }
    public function setDayLength(int $dayLength): self
    {
        $this->dayLength = $dayLength;
        return $this;
    }
    public function getEmployee() : Employee
    {
        return $this->employee;
    }
    public function setEmployee(Employee $employee)
    {
        $this->employee = $employee;
    }
}