<?php

namespace TclBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Feed controller.
 *
 */
class FeedController extends Controller
{

    /**
     * Lists all Feed entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('TclBundle:Feed')->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('TclBundle:Feed:index.html.twig', array(
            'pagination' => $pagination,
        ));
    }

    /**
     * Finds and displays a Feed entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TclBundle:Feed')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Feed entity.');
        }

        return $this->render('TclBundle:Feed:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}
