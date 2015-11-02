<?php

namespace TclBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TclBundle:Default:index.html.twig');
    }
}
