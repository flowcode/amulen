<?php

namespace Flowcode\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Flowcode\MediaBundle\Entity\MediaType;

/**
 * Description of LoadUserData
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class LoadMediaTypeData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        /* Create Image Media Type */
        $mediatypeImage = new MediaType();
        $mediatypeImage->setName("image");
        $mediatypeImage->setEnabled(true);

        $manager->persist($mediatypeImage);
        $this->addReference("media_type_image", $mediatypeImage);
        
        /* Create Video Media Type */
        $mediatypeVideo = new MediaType();
        $mediatypeVideo->setName("video");
        $mediatypeVideo->setEnabled(true);

        $manager->persist($mediatypeVideo);
        $this->addReference("media_type_video", $mediatypeVideo);
        
        /* Create Audio Media Type */
        $mediatypeAudio = new MediaType();
        $mediatypeAudio->setName("audio");
        $mediatypeAudio->setEnabled(true);

        $manager->persist($mediatypeAudio);
        $this->addReference("media_type_audio", $mediatypeAudio);

        $manager->flush();
    }

    public function getOrder() {
        return 3;
    }

}
