<?php

namespace Domotique\DomoboxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DomotiqueDomoboxBundle:Default:index.html.twig', array('name' => "test"));
    }
}
