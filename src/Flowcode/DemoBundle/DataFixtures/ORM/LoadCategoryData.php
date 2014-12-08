<?php

namespace Flowcode\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Flowcode\ClassificationBundle\Entity\Category;

/**
 * Description of LoadUserData
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        /* Create defaults categories  */
        $cat_productos = new Category();
        $cat_productos->setName("productos");
        $manager->persist($cat_productos);
        $this->addReference("cat_productos", $cat_productos);

        /* Create products categories  */
        $cat_merch_textil = new Category();
        $cat_merch_textil->setName("Merchadising Textil");
        $cat_merch_textil->setParent($cat_productos);
        $manager->persist($cat_merch_textil);
        $this->addReference("cat_merch_textil", $cat_merch_textil);

        $cat_merch_promo = new Category();
        $cat_merch_promo->setName("Merchadising Promocional");
        $cat_merch_promo->setParent($cat_productos);
        $manager->persist($cat_merch_promo);
        $this->addReference("cat_merch_promo", $cat_merch_promo);

        $manager->flush();
    }

    public function getOrder() {
        return 1;
    }

}
