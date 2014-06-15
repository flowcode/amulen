<?php

namespace Flowcode\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Flowcode\PageBundle\Entity\Page;

/**
 * Page controller.
 *
 * @Route("/{_locale}")
 */
class PageController extends Controller {

    /**
     * Lists all Page entities.
     *
     * @Route("/{slug}", name="page")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($slug) {

        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('FlowcodePageBundle:Page')->findOneBy(array("slug" => $slug));
        if (!$page) {
            return $this->redirect($this->generateUrl('home'));
        }

        $response = $this->forward('FlowcodePageBundle:Page:show', array(
            'id' => $page->getId(),
        ));
        return $response;
    }

    /**
     * Finds and displays a Page entity.
     *
     * @Route("/{id}", name="page_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodePageBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }
        //'AcmeHelloBundle:Hello:index.html.twig'
        return $this->render($entity->getTemplate(), array('page' => $entity));
    }

}
