<?php

namespace Flowcode\ShopBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Flowcode\UserBundle\Entity\User;
use Gedmo\Mapping\Annotation as Gedmo;

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
     * @ManyToOne(targetEntity="ProductOrderStatus", inversedBy="productorders")
     * @JoinColumn(name="product_order_status_id", referencedColumnName="id")
     * */
    private $status;

    /**
     * @ManyToOne(targetEntity="Flowcode\UserBundle\Entity\User", inversedBy="productorders")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     * */
    private $user;

    /**
     * @OneToMany(targetEntity="ProductOrderItem", mappedBy="order", cascade={"persist", "remove"})
     * */
    private $items;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on = "update")
     * @ORM\Column(type = "datetime")
     */
    private $updated;

    function __construct() {
        $this->items = new ArrayCollection();
        $this->enabled = true;
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
     * @param ProductOrderItem $items
     * @return ProductOrder
     */
    public function addItem(ProductOrderItem $items) {
        $this->items[] = $items;

        return $this;
    }

    /**
     * Remove items
     *
     * @param ProductOrderItem $items
     */
    public function removeItem(ProductOrderItem $items) {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return Collection 
     */
    public function getItems() {
        return $this->items;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return ProductOrder
     */
    public function setUser(User $user = null) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User 
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Set status
     *
     * @param \Flowcode\ShopBundle\Entity\ProductOrderStatus $status
     * @return ProductOrder
     */
    public function setStatus(\Flowcode\ShopBundle\Entity\ProductOrderStatus $status = null) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Flowcode\ShopBundle\Entity\ProductOrderStatus 
     */
    public function getStatus() {
        return $this->status;
    }


    /**
     * Set created
     *
     * @param \DateTime $created
     * @return ProductOrder
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return ProductOrder
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
