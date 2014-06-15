<?php

namespace Flowcode\NewsBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Post controller.
 *
 * @Route("/{_locale}/post")
 */
class PostController extends Controller {

    /**
     * Lists all Post entities.
     *
     * @Route("/", name="post")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request) {

        $seoPage = $this->container->get('sonata.seo.page');

        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('FlowcodePageBundle:Page')->findOneBy(array("name" => "news"));
        if ($page) {
            $titleBlock = $page->getBlock("title");
            if (!is_null($page)) {
                $seoPage->setTitle($titleBlock->getContent());
            }
        } else {
            $seoPage->setTitle("News");
        }

        $pageNumber = $request->get("page", 1);
        $posts = $this->getDoctrine()->getRepository("FlowcodeNewsBundle:Post")->findAllEnabled();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($posts, $this->get('request')->query->get('page', $pageNumber), 2);

        return array(
            'pagination' => $pagination,
        );
    }

    /**
     * Finds and displays a Post entity.
     *
     * @Route("/{id}", name="post_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeNewsBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        return array(
            'entity' => $entity,
        );
    }

}
