<?php

namespace Flowcode\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * BlockType
 *
 * @ORM\Table(name="page_block_type")
 * @ORM\Entity
 */
class BlockType {

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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @OneToMany(targetEntity="Block", mappedBy="blockType")
     * */
    private $blocks;

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
     * @return BlockType
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
     * @return BlockType
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
        $this->blocks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add blocks
     *
     * @param \Flowcode\PageBundle\Entity\Block $blocks
     * @return BlockType
     */
    public function addBlock(\Flowcode\PageBundle\Entity\Block $blocks) {
        $this->blocks[] = $blocks;

        return $this;
    }

    /**
     * Remove blocks
     *
     * @param \Flowcode\PageBundle\Entity\Block $blocks
     */
    public function removeBlock(\Flowcode\PageBundle\Entity\Block $blocks) {
        $this->blocks->removeElement($blocks);
    }

    /**
     * Get blocks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBlocks() {
        return $this->blocks;
    }
    
    public function __toString() {
        return $this->name;
    }


}
