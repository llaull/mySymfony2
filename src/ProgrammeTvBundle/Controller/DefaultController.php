<?php

namespace ProgrammeTvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProgrammeTvBundle:Default:index.html.twig', array('name' => $name));
    }
}
