<?php

namespace CarnetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function indexAction()
    {
        $entity = $this->getDoctrine()
            ->getRepository('CarnetsBundle:Carnet')
            ->findAllActived();

        return $this->render('CarnetsBundle:Default:accueil.html.twig', array('carnets' => $entity));
    }


}
