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

    public function indexBlogAction()
    {

        $em = $this->getDoctrine()->getManager();
        $entities = $this->getDoctrine()->getRepository('CarnetsBundle:BlogArticle');
        $entities = $entities->findArticleWithInfo($em);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1),1
        );


        return $this->render('CarnetsBundle:BlogArticle:show.html.twig', array(
            'entities' => $pagination,
        ));
    }

}
