<?php

namespace CarnetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function indexAction()
    {
        //les lieux visites
        $lieux = $this->getDoctrine()
            ->getRepository('CarnetsBundle:Lieu')
            ->allCoordonnee();

        //les carnets
        $carnets = $this->getDoctrine()
            ->getRepository('CarnetsBundle:Carnet')
            ->findAllActived();

        return $this->render('CarnetsBundle:Default:accueil.html.twig', array('carnets' => $carnets, 'lieux' => $lieux));
    }

}
