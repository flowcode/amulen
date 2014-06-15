<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Flowcode\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of SliderController
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class SliderController extends Controller {

    public function mainSliderAction($max = 3) {
        $em = $this->getDoctrine()->getManager();
        $id = 1;
        $entity = $em->getRepository('FlowcodeMediaBundle:Gallery')->find($id);
        return $this->render(
                        'FlowcodeMediaBundle:Slider:slider.html.twig', array('gallery' => $entity)
        );
    }

}
