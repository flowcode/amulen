<?php

namespace Flowcode\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * ProductOrderStatus
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ProductOrderStatusRepository")
 */
class ProductOrderStatus {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @OneToMany(targetEntity="ProductOrder", mappedBy="status")
     * */
    private $productorders;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ProductOrderStatus
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return ProductOrderStatus
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->productorders = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add productorders
     *
     * @param \Flowcode\ShopBundle\Entity\ProductOrder $productorders
     * @return ProductOrderStatus
     */
    public function addProductorder(\Flowcode\ShopBundle\Entity\ProductOrder $productorders) {
        $this->productorders[] = $productorders;

        return $this;
    }

    /**
     * Remove productorders
     *
     * @param \Flowcode\ShopBundle\Entity\ProductOrder $productorders
     */
    public function removeProductorder(\Flowcode\ShopBundle\Entity\ProductOrder $productorders) {
        $this->productorders->removeElement($productorders);
    }

    /**
     * Get productorders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductorders() {
        return $this->productorders;
    }

    public function __toString() {
        return $this->name;
    }

}
