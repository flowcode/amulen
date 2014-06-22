<?php

namespace Flowcode\ProjectBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Project
 *
 * @ORM\Table(name="project_project")
 * @ORM\Entity(repositoryClass="ProjectRepository")
 */
class Project {

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
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="abstract", type="string", length=255)
     */
    private $abstract;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @ManyToOne(targetEntity="Flowcode\ClassificationBundle\Entity\Category")
     * @JoinColumn(name="category_id", referencedColumnName="id")
     * */
    private $category;

    /**
     * @ManyToMany(targetEntity="Flowcode\ClassificationBundle\Entity\Tag")
     * @JoinTable(name="project_tag",
     *      joinColumns={@JoinColumn(name="project_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     * */
    private $tags;

    /**
     * @OneToOne(targetEntity="Flowcode\MediaBundle\Entity\Gallery")
     * @JoinColumn(name="media_gallery_id", referencedColumnName="id")
     * */
    private $mediaGallery;

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
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    function __construct() {
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
     * @return Project
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
     * @return Project
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
     * Set abstract
     *
     * @param string $abstract
     * @return Project
     */
    public function setAbstract($abstract) {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get abstract
     *
     * @return string 
     */
    public function getAbstract() {
        return $this->abstract;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Project
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
     * Set enabled
     *
     * @param boolean $enabled
     * @return Project
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
     * Set created
     *
     * @param \DateTime $created
     * @return Project
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Project
     */
    public function setUpdated($updated) {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated() {
        return $this->updated;
    }

    /**
     * Get category
     *
     * @return Flowcode\ClassificationBundle\Entity\Category 
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Add tags
     *
     * @param \Flowcode\ClassificationBundle\Entity\Tag $tags
     * @return Project
     */
    public function addTag(\Flowcode\ClassificationBundle\Entity\Tag $tags) {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Flowcode\ClassificationBundle\Entity\Tag $tags
     */
    public function removeTag(\Flowcode\ClassificationBundle\Entity\Tag $tags) {
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

    /**
     * Set mediaGallery
     *
     * @param \Flowcode\MediaBundle\Entity\Gallery $mediaGallery
     * @return Project
     */
    public function setMediaGallery(\Flowcode\MediaBundle\Entity\Gallery $mediaGallery = null) {
        $this->mediaGallery = $mediaGallery;

        return $this;
    }

    /**
     * Get mediaGallery
     *
     * @return \Flowcode\MediaBundle\Entity\Gallery 
     */
    public function getMediaGallery() {
        return $this->mediaGallery;
    }

    public function __toString() {
        return $this->name;
    }

    /**
     * Set category
     *
     * @param \Flowcode\ClassificationBundle\Entity\Category $category
     * @return Project
     */
    public function setCategory(\Flowcode\ClassificationBundle\Entity\Category $category = null) {
        $this->category = $category;

        return $this;
    }

    public function getImage() {
        $webPath = "";
        if (!is_null($this->mediaGallery) && $this->mediaGallery->getGalleryItems()->count() > 0) {
            $webPath = "/" . $this->getMediaGallery()->getGalleryItems()->first()->getMedia()->getWebPath();
        } else {
            $webPath = "http://placehold.it/160";
        }
        return $webPath;
    }

}
