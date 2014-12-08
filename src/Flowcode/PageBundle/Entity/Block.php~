<?php

namespace Flowcode\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Block
 *
 * @ORM\Table(name="page_block")
 * @ORM\Entity(repositoryClass="BlockRepository")
 */
class Block implements \Gedmo\Translatable\Translatable {

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
     * @Gedmo\Translatable
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @ManyToOne(targetEntity="Page", inversedBy="blocks")
     * @JoinColumn(name="page_id", referencedColumnName="id")
     * */
    private $page;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    private $locale;

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
     * @return Block
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
     * Set lang
     *
     * @param string $lang
     * @return Block
     */
    public function setLang($lang) {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string 
     */
    public function getLang() {
        return $this->lang;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Block
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set page
     *
     * @param \Flowcode\PageBundle\Entity\Page $page
     * @return Block
     */
    public function setPage(\Flowcode\PageBundle\Entity\Page $page = null) {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \Flowcode\PageBundle\Entity\Page 
     */
    public function getPage() {
        return $this->page;
    }

    public function __toString() {
        return $this->name;
    }

    public function setTranslatableLocale($locale) {
        $this->locale = $locale;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Block
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType() {
        return $this->type;
    }

}
