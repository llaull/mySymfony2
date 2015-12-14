<?php

namespace CarnetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CarnetsBundle\Entity\Lieu;

//use AlertBundle\Entity\Alert;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $entity = $this->getDoctrine()
            ->getRepository('CarnetsBundle:Carnet')
            ->findAllActived();

        return $this->render('CarnetsBundle:Default:carnet.html.twig', array('carnets' => $entity));
    }


}
