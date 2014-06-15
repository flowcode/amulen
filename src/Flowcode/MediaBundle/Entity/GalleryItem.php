<?php

namespace Flowcode\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Flowcode\MediaBundle\Entity\Gallery;
use Flowcode\MediaBundle\Entity\GalleryItem;
use Flowcode\MediaBundle\Entity\Media;

/**
 * GalleryItem
 *
 * @ORM\Table(name="media_gallery_item")
 * @ORM\Entity
 */
class GalleryItem {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="smallint")
     */
    private $position;

    /**
     * @OneToOne(targetEntity="Media")
     * @JoinColumn(name="media_id", referencedColumnName="id")
     * */
    private $media;

    /**
     * @ManyToOne(targetEntity="Gallery", inversedBy="galleryItems")
     * @JoinColumn(name="gallery_id", referencedColumnName="id")
     * */
    private $gallery;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return GalleryItem
     */
    public function setPosition($position) {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition() {
        return $this->position;
    }


    /**
     * Set media
     *
     * @param \Flowcode\MediaBundle\Entity\Media $media
     * @return GalleryItem
     */
    public function setMedia(\Flowcode\MediaBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \Flowcode\MediaBundle\Entity\Media 
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set gallery
     *
     * @param \Flowcode\MediaBundle\Entity\Gallery $gallery
     * @return GalleryItem
     */
    public function setGallery(\Flowcode\MediaBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Flowcode\MediaBundle\Entity\Gallery 
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
