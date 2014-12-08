<?php

namespace Flowcode\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FlowcodeNewsBundle:Default:index.html.twig', array('name' => $name));
    }
}
