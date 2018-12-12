<?php
namespace App\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Item
 *
 * @ORM\Table(name="items")
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 */
class Item
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     * @Assert\Type("string")
     */
    private $name;
    /**
     * @ORM\Column(name="expirationDate", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $expirationDate;
    /**
     * @ORM\Column(name="amount", type="integer", nullable=false)
     * @Assert\Type("integer")
     */
    private $amount;

    /**
     * @ORM\ManyToMany(targetEntity="Order", mappedBy="items")
     */
    private $orders;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Warehouse", inversedBy="items")
     * @ORM\JoinColumn(name="warehouse_id", referencedColumnName="id")
     */
    private $warehouse;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getAmount()
    {
        return $this->amount;
    }
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }
    public function reduceAmount($amount)
    {
        $this->amount -= $amount;
    }
    public function getOrders()
    {
        return $this->orders;
    }
    public function addOrder($order)
    {
        $this->orders->add($order);
    }
    public function getExpirationDate()
    {
            return $this->expirationDate;
    }
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;
    }

}