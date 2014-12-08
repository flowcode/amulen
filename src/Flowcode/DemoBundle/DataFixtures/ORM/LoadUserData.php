<?php

namespace Flowcode\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of LoadUserData
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class LoadUserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function load(ObjectManager $manager) {
        $userManager = $this->container->get('fos_user.user_manager');

        // Create a new user 1
        $admin1 = $userManager->createUser();
        $admin1->setUsername('admin1');
        $admin1->setEmail('admin1@mail.com');
        $admin1->setPlainPassword('admin1');
        $admin1->setEnabled(true);
        $admin1->setRoles(array('ROLE_ADMIN'));
        $manager->persist($admin1);

        // Create a new user 1
        $user1 = $userManager->createUser();
        $user1->setUsername('user1');
        $user1->setEmail('user1@mail.com');
        $user1->setPlainPassword('user1');
        $user1->setEnabled(true);
        $user1->setRoles(array('ROLE_USER'));
        $manager->persist($user1);

        // Create a new user 2
        $user2 = $userManager->createUser();
        $user2->setUsername('user2');
        $user2->setEmail('user2@mail.com');
        $user2->setPlainPassword('user2');
        $user2->setEnabled(true);
        $user2->setRoles(array('ROLE_USER'));
        $manager->persist($user2);

        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function getOrder() {
        return 2;
    }

}
