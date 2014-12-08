<?php

namespace Flowcode\DemoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/{_locale}")
 */
class DefaultController extends Controller {

    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('FlowcodePageBundle:Page')->findOneBy(array("name" => "name"));
        $block = $em->getRepository('FlowcodePageBundle:Block')->findOneBy(array("name" => "welcome"));

        return array(
            'welcome' => $block->getContent(),
        );
    }

}
