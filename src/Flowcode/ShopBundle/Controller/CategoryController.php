<?php

namespace Flowcode\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Flowcode\ClassificationBundle\Entity\Category;

/**
 * Category controller.
 *
 * @Route("/category")
 */
class CategoryController extends Controller {

    /**
     * Lists all Category entities.
     *
     * @Route("/", name="category")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('FlowcodeClassificationBundle:Category')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    public function activesAction() {
        $em = $this->getDoctrine()->getManager();
        $rootName = $this->container->getParameter('flowcode_shop.root_category');
        $root = $em->getRepository('FlowcodeClassificationBundle:Category')->findOneBy(array("name" => $rootName));
        $entities = $em->getRepository('FlowcodeClassificationBundle:Category')->getChildren($root);

        return $this->render(
                        'FlowcodeShopBundle:Category:leftcolumn.html.twig', array('entities' => $entities)
        );
    }

    /**
     * Finds and displays a Category entity.
     *
     * @Route("/{id}", name="category_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeClassificationBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        return array(
            'entity' => $entity,
        );
    }

}
