<?php

namespace Flowcode\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * ProductOrderItem
 *
 * @ORM\Table(name="shop_order_item")
 * @ORM\Entity
 */
class ProductOrderItem {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ManyToOne(targetEntity="ProductOrder", inversedBy="items")
     * @JoinColumn(name="order_id", referencedColumnName="id")
     * */
    private $order;
    
    /**
     * @OneToOne(targetEntity="Product")
     * @JoinColumn(name="product_id", referencedColumnName="id")
     **/
    private $product;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return ProductOrderItem
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity() {
        return $this->quantity;
    }


    /**
     * Set order
     *
     * @param \Flowcode\ShopBundle\Entity\ProductOrder $order
     * @return ProductOrderItem
     */
    public function setOrder(\Flowcode\ShopBundle\Entity\ProductOrder $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Flowcode\ShopBundle\Entity\ProductOrder 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set product
     *
     * @param \Flowcode\ShopBundle\Entity\Product $product
     * @return ProductOrderItem
     */
    public function setProduct(\Flowcode\ShopBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Flowcode\ShopBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
