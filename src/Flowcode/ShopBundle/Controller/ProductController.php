<?php

namespace Flowcode\ShopBundle\Controller;

use Flowcode\ShopBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Product controller.
 *
 * @Route("/{_locale}/product")
 */
class ProductController extends Controller {

    /**
     * Lists all Product entities.
     *
     * @Route("/", name="product")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        
        /* seo metadata */
        $seoPage = $this->container->get('sonata.seo.page');
        $baseTitle = $seoPage->getTitle();
        $title = "Productos - " . $baseTitle;
        $seoPage->setTitle($title);

        /* pagination */
        $pageNumber = $request->get("page", 1);
        $products = $this->getDoctrine()->getRepository("FlowcodeShopBundle:Product")->findEnabledByPageAndCategory();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($products, $this->get('request')->query->get('page', $pageNumber), 2);

        return array(
            'pagination' => $pagination,
        );
        
    }
    /**
     * Lists all Product entities.
     *
     * @Route("/category/{slug}", name="product_by_category")
     * @Method("GET")
     * @Template("FlowcodeShopBundle:Product:index.html.twig")
     */
    public function listByCategoryAction(Request $request, $slug) {
        $em = $this->getDoctrine()->getManager();
        
        /* seo metadata */
        $seoPage = $this->container->get('sonata.seo.page');
        $baseTitle = $seoPage->getTitle();
        $title = "Productos - " . $baseTitle;
        $seoPage->setTitle($title);

        /* pagination */
        $pageNumber = $request->get("page", 1);
        $products = $this->getDoctrine()->getRepository("FlowcodeShopBundle:Product")->findEnabledByPageAndCategory($slug);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($products, $this->get('request')->query->get('page', $pageNumber), 2);

        return array(
            'pagination' => $pagination,
        );
        
    }

    /**
     * Finds and displays a Product entity.
     *
     * @Route("/{slug}", name="product_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($slug) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeShopBundle:Product')->findOneBy(array("slug" => $slug));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        } else {
            $seoPage = $this->container->get('sonata.seo.page');
            $baseTitle = $seoPage->getTitle();
            $title = ucfirst($entity->getName()) . " - Productos - " . $baseTitle;
            $seoPage->setTitle($title);
        }

        return array(
            'entity' => $entity,
        );
    }

}
