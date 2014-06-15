<?php

namespace Flowcode\TagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FlowcodeTagBundle:Default:index.html.twig', array('name' => $name));
    }
}
