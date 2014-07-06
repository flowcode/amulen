<?php

namespace Flowcode\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Media
 *
 * @ORM\Table(name="media_media")
 * @ORM\Entity(repositoryClass="MediaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Media {

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
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @ManyToOne(targetEntity="MediaType", inversedBy="medias")
     * @JoinColumn(name="media_type_id", referencedColumnName="id")
     * */
    private $mediaType;

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
     * @return Media
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
     * Set path
     *
     * @param string $path
     * @return Media
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Media
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
     * Set mediaType
     *
     * @param MediaType $mediaType
     * @return Media
     */
    public function setMediaType(MediaType $mediaType = null) {
        $this->mediaType = $mediaType;

        return $this;
    }

    /**
     * Get mediaType
     *
     * @return MediaType 
     */
    public function getMediaType() {
        return $this->mediaType;
    }

    public function getAbsolutePath() {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath() {
        //return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
        return $this->path;
    }

    protected function getUploadRootDir() {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        return 'uploads/media';
    }

    public function __toString() {
        return $this->name;
    }

}
