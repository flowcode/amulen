<?php

namespace Flowcode\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Flowcode\PageBundle\Entity\Page;

/**
 * Description of LoadUserData
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class LoadPageData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        /* Create Homepage */
        $homepage = new Page();
        $homepage->setName("Homepage");
        $homepage->setDescription("Default Homepage.");
        $homepage->setTemplate("default");
        $homepage->setEnabled(true);
        $manager->persist($homepage);
        $this->addReference("page_homepage", $homepage);

        /* Create Products */
        $page_products = new Page();
        $page_products->setName("Products");
        $page_products->setDescription("Default products page.");
        $page_products->setTemplate("default");
        $page_products->setEnabled(true);

        $manager->persist($page_products);
        $this->addReference("page_products", $page_products);

        $manager->flush();
    }

    public function getOrder() {
        return 3;
    }

}
