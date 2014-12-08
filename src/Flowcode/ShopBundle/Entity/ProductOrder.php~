<?php

namespace Flowcode\ShopBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * ProductOrder
 *
 * @ORM\Table(name="shop_order")
 * @ORM\Entity(repositoryClass="ProductOrderRepository")
 */
class ProductOrder {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @OneToMany(targetEntity="ProductOrderItem", mappedBy="order")
     * */
    private $items;

    function __construct() {
        $this->items = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return ProductOrder
     */
    public function setTotal($total) {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal() {
        return $this->total;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return ProductOrder
     */
    public function setEnabled($enabled) {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled() {
        return $this->enabled;
    }


    /**
     * Add items
     *
     * @param \Flowcode\ShopBundle\Entity\ProductOrderItem $items
     * @return ProductOrder
     */
    public function addItem(\Flowcode\ShopBundle\Entity\ProductOrderItem $items)
    {
        $this->items[] = $items;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \Flowcode\ShopBundle\Entity\ProductOrderItem $items
     */
    public function removeItem(\Flowcode\ShopBundle\Entity\ProductOrderItem $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }
}
