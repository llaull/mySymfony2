<?php

namespace CarnetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $entity = $this->getDoctrine()
            ->getRepository('CarnetsBundle:Carnet')
            ->findAllActived();

        return $this->render('CarnetsBundle:Default:accueil.html.twig', array('carnets' => $entity));
    }


    public function allLieuAction()
    {
        $entities = $this->getDoctrine()
            ->getRepository('CarnetsBundle:Lieu')
            ->allCoordonnee();

        return new JsonResponse(array('lieux' => $entities));
    }
}
