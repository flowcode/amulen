<?php

namespace Flowcode\ClassificationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Classification controller.
 *
 * @Route("/admin/classification")
 */
class ClassificationController extends Controller {

    /**
     * @Route("/", name="admin_classification")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        return array("entity" => "hi");
    }

}
