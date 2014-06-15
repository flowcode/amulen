<?php

namespace Flowcode\DashboardBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Dashboard Class.
 * 
 * @Route("/admin")
 */
class DefaultController extends Controller {

    /**
     * Main Dashboard.
     *
     * @Route("/", name="admin_dashboard")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        
        
        
        return $this->render('FlowcodeDashboardBundle:Default:index.html.twig', array());
    }

}
