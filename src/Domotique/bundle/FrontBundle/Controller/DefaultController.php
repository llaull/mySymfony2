<?php

namespace Domotique\bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DomotiquebundleFrontBundle:Default:index.html.twig', array('name' => 'toi'));
    }
}
