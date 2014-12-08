<?php

namespace Flowcode\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Flowcode\MediaBundle\Entity\Gallery;
use Flowcode\MediaBundle\Entity\GalleryItem;
use Flowcode\MediaBundle\Entity\Media;

/**
 * Description of LoadUserData
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class LoadSliderData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        /* Create Homepage blocks */
        $slider_main = new Gallery();
        $slider_main->setName("Slider Main");
        $slider_main->setEnabled(true);
        $manager->persist($slider_main);

        /**/
        $media = new Media();
        $media->setPath("uploads/slider/fhonda1024.png");
        $media->setName("fhonda1024");
        $media->setMediaType($this->getReference("media_type_image"));
        $media->setEnabled(true);
        $manager->persist($media);

        $slider_main_item1 = new GalleryItem();
        $slider_main_item1->setMedia($media);
        $slider_main_item1->setGallery($slider_main);
        $slider_main_item1->setPosition(0);
        $manager->persist($slider_main_item1);
        

        /**/
        $media2 = new Media();
        $media2->setPath("uploads/slider/fjeep1024.png");
        $media2->setName("fhonda1024");
        $media2->setMediaType($this->getReference("media_type_image"));
        $media2->setEnabled(true);
        $manager->persist($media);

        $slider_main_item2 = new GalleryItem();
        $slider_main_item2->setMedia($media2);
        $slider_main_item2->setGallery($slider_main);
        $slider_main_item2->setPosition(1);
        $manager->persist($slider_main_item2);
        
//        $slider_main->addGalleryItem($slider_main_item1);
//        $slider_main->addGalleryItem($slider_main_item2);
        

        $manager->flush();
    }

    public function getOrder() {
        return 4;
    }

}
