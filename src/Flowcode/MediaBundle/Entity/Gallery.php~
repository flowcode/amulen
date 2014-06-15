<?php

namespace Flowcode\MediaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Gallery
 *
 * @ORM\Table(name="media_gallery")
 * @ORM\Entity(repositoryClass="GalleryRepository")
 */
class Gallery {

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
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @OneToMany(targetEntity="GalleryItem", mappedBy="gallery")
     * */
    private $galleryItems;

    /**
     * @ManyToMany(targetEntity="Flowcode\TagBundle\Entity\Tag")
     * @JoinTable(name="media_gallery_tag",
     *      joinColumns={@JoinColumn(name="gallery_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     * */
    private $tags;

    function __construct() {
        $this->galleryItems = new ArrayCollection();
        $this->tags = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Gallery
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
     * Set slug
     *
     * @param string $slug
     * @return Gallery
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Gallery
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
     * Add galleryItems
     *
     * @param \Flowcode\MediaBundle\Entity\GalleryItem $galleryItems
     * @return Gallery
     */
    public function addGalleryItem(\Flowcode\MediaBundle\Entity\GalleryItem $galleryItems) {
        $this->galleryItems[] = $galleryItems;

        return $this;
    }

    /**
     * Remove galleryItems
     *
     * @param \Flowcode\MediaBundle\Entity\GalleryItem $galleryItems
     */
    public function removeGalleryItem(\Flowcode\MediaBundle\Entity\GalleryItem $galleryItems) {
        $this->galleryItems->removeElement($galleryItems);
    }

    /**
     * Get galleryItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGalleryItems() {
        return $this->galleryItems;
    }

    /**
     * Add tags
     *
     * @param \Flowcode\TagBundle\Entity\Tag $tags
     * @return Gallery
     */
    public function addTag(\Flowcode\TagBundle\Entity\Tag $tags) {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Flowcode\TagBundle\Entity\Tag $tags
     */
    public function removeTag(\Flowcode\TagBundle\Entity\Tag $tags) {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags() {
        return $this->tags;
    }

    public function __toString() {
        return $this->name;
    }

}
