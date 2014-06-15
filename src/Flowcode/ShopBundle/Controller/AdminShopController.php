<?php

namespace Flowcode\ShopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Category controller.
 *
 * @Route("/admin/shop")
 */
class AdminShopController extends Controller {

    /**
     * Shop dashboard
     *
     * @Route("/", name="admin_shop_dashboard")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {

        return array(
            'entities' => "hi",
        );
    }

}
