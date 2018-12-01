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
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="Šis e-mail adresas jau užimtas..")
 * @UniqueEntity(fields={"username"}, message="Šis vartotojo vardas jau užimtas.")
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
     * @ORM\Column(name="amount", type="int", nullable=false)
     * @Assert\Type("int")
     */
    private $amount;

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
    public function getExpirationDate(): ?DateTime
    {
        return $this->expirationDate;
    }
    public function setExpirationDate(string $expirationDate): self
    {
        $this->expirationDate = $expirationDate;
    }

}