<?php


namespace App\Entity;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @Entity
 * @Table(name="expense")
 */
class Expense
{

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Item", cascade={"persist"})
     * @JoinColumn(name="item_id", referencedColumnName="id")
     * @NotBlank()
     */
    private $item;

    /**
     * @Column(type="integer")
     * @NotBlank()
     */
    private $count;

    /**
     * @Column(type="decimal")
     * @NotBlank()
     */
    private $amount;

    /**
     * @Column(type="date")
     */
    private $date;

    /**
     * @Column(type="time", options={"default": null}, nullable=true)
     */
    private $time;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param mixed $item
     * @return Expense
     */
    public function setItem($item): self
    {
        $this->item = $item;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     * @return Expense
     */
    public function setCount($count): self
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     * @return Expense
     */
    public function setAmount($amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return Expense
     */
    public function setDate($date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     * @return Expense
     */
    public function setTime($time): self
    {
        $this->time = $time;
        return $this;
    }

}