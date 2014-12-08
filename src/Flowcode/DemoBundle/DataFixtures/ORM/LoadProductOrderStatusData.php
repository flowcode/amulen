<?php

namespace Flowcode\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Flowcode\MediaBundle\Entity\MediaType;
use Flowcode\ShopBundle\Entity\ProductOrderStatus;

/**
 * Description of LoadUserData
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class LoadProductOrderStatusData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        /* Create New status */
        $statusNew = new ProductOrderStatus();
        $statusNew->setName("Nuevo");
        $statusNew->setDescription("Pedido nuevo, pendiente de ser aceptado por CNImagen.");

        $manager->persist($statusNew);
        $this->addReference("product_order_status_new", $statusNew);
        
        /* Create Accepted status */
        $statusAccepted = new ProductOrderStatus();
        $statusAccepted->setName("Aceptado");
        $statusAccepted->setDescription("Pedido aceptado por CNImagen.");

        $manager->persist($statusAccepted);
        $this->addReference("product_order_status_accepted", $statusAccepted);
        
        /* Create Rejected status */
        $statusRejected = new ProductOrderStatus();
        $statusRejected->setName("Rechazado");
        $statusRejected->setDescription("Pedido rechazado por CNImagen.");

        $manager->persist($statusRejected);
        $this->addReference("product_order_status_rejected", $statusRejected);

        $manager->flush();
    }

    public function getOrder() {
        return 3;
    }

}
