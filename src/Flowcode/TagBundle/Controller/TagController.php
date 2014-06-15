<?php

namespace Flowcode\TagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Flowcode\TagBundle\Entity\Tag;

/**
 * Tag controller.
 *
 * @Route("/tag")
 */
class TagController extends Controller {

    /**
     * Lists all Tag entities.
     *
     * @Route("/", name="tag")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FlowcodeTagBundle:Tag')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Tag entity.
     *
     * @Route("/{id}", name="tag_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeTagBundle:Tag')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tag entity.');
        }

        return array(
            'entity' => $entity,
        );
    }

    public function newsTagsAction($max = 3) {
        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository('FlowcodeTagBundle:Tag')->findAll();

        return $this->render(
                        'FlowcodeTagBundle:Tag:widget-tags.html.twig', array('tags' => $tags)
        );
    }

}
