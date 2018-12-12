<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="state", type="integer", nullable=false)
     * @Assert\Type("integer")
     * * @Assert\LessThan(
     *     value = 4
     * )
     */
    private $state;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Warehouse", inversedBy="orders")
     * @ORM\JoinColumn(name="warehouse_id", referencedColumnName="id")
     */
    private $warehouse;

    /**
     * @ORM\ManyToMany(targetEntity="Item", inversedBy="orders")
     * @ORM\JoinTable(name="orders_items")
     */
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }
    /**
     * @param int $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }
    /**
     * @return mixed
     */
    public function getWarehouse()
    {
        return $this->warehouse;
    }
    /**
     * @param int $warehouse
     */
    public function setWarehouse($warehouse)
    {
        $this->warehouse = $warehouse;
    }
    public function getItems()
    {
        return $this->items;
    }
    public function addItem($item)
    {
        $this->items->add($item);
    }
    public function getUsedItems()
    {
        $total = 0;
        foreach($this->items as $item) {
            $total += 1;
        }
        return $total;
    }

}