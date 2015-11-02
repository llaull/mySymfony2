<?php

namespace Domotique\bundle\TaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DomotiquebundleTaskBundle:Default:index.html.twig', array('name' => $name));
    }
}
