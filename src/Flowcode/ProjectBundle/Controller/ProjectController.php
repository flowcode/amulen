<?php

namespace Flowcode\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Flowcode\ProjectBundle\Entity\Project;

/**
 * Project controller.
 *
 * @Route("/{_locale}/project")
 */
class ProjectController extends Controller {

    /**
     * Lists all Project entities.
     *
     * @Route("/", name="project")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $seoPage = $this->container->get('sonata.seo.page');

        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('FlowcodePageBundle:Page')->findOneBy(array("name" => "projects"));
        if ($page) {
            $titleBlock = $page->getBlock("title");
            if (!is_null($page)) {
                $seoPage->setTitle($titleBlock->getContent());
            }
        } else {
            $seoPage->setTitle("Projects");
        }

        $entities = $em->getRepository('FlowcodeProjectBundle:Project')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Project entity.
     *
     * @Route("/{id}", name="project_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeProjectBundle:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        return array(
            'entity' => $entity,
        );
    }

}
