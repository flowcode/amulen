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
        $media->setPath("uploads/slider/demo/ad0fc0a26bcadae1bd079b92624acc9ee94a0c19.jpeg");
        $media->setName("bicicleta1");
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
        $media2->setPath("uploads/slider/demo/5f8864b9118fbdc90412139dd543e6ced7e98f8a.jpeg");
        $media2->setName("bicicleta2");
        $media2->setMediaType($this->getReference("media_type_image"));
        $media2->setEnabled(true);
        $manager->persist($media);

        $slider_main_item2 = new GalleryItem();
        $slider_main_item2->setMedia($media2);
        $slider_main_item2->setGallery($slider_main);
        $slider_main_item2->setPosition(1);
        $manager->persist($slider_main_item2);
        
        /**/
        $media2 = new Media();
        $media2->setPath("uploads/slider/demo/636bfaa791751ac84de249dac03bdbd74bb5d918.jpeg");
        $media2->setName("bicicleta3");
        $media2->setMediaType($this->getReference("media_type_image"));
        $media2->setEnabled(true);
        $manager->persist($media);

        $slider_main_item2 = new GalleryItem();
        $slider_main_item2->setMedia($media2);
        $slider_main_item2->setGallery($slider_main);
        $slider_main_item2->setPosition(2);
        $manager->persist($slider_main_item2);

        /**/
        $media2 = new Media();
        $media2->setPath("uploads/slider/demo/8f62362359901b88e537bc1eda640f3a7ac37f45.jpeg");
        $media2->setName("bicicleta4");
        $media2->setMediaType($this->getReference("media_type_image"));
        $media2->setEnabled(true);
        $manager->persist($media);

        $slider_main_item2 = new GalleryItem();
        $slider_main_item2->setMedia($media2);
        $slider_main_item2->setGallery($slider_main);
        $slider_main_item2->setPosition(3);
        $manager->persist($slider_main_item2);                
        
/*        389755456_9faf8b8e42_z.jpg                     
        images (1).jpg
        2008_006467.jpg                        
        Mountain-bike-racing.jpg
        saraclawsonsoigneur_3daysaxel.jpg
        Tracy-Moseley2.jpg*/


//        $slider_main->addGalleryItem($slider_main_item1);
//        $slider_main->addGalleryItem($slider_main_item2);
        

        $manager->flush();
    }

    public function getOrder() {
        return 4;
    }

}
