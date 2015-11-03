<?php

namespace Domotique\bundle\ModuleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Domotique\bundle\ModuleBundle\Entity\Logs;
use Domotique\bundle\ModuleBundle\Repository;

/**
 * Logs controller.
 *
 */
class LogsController extends Controller
{

    /**
     * affiche en temps les logs
     *
     */
    public function tempsReelAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entities = $this->getDoctrine()->getRepository('DomotiquebundleModuleBundle:Logs');
        $entities = $entities->reelTime($em);

        return new JsonResponse(array('name' => $entities));
    }
    /**
     * Lists all Logs entities.
     *
     */
    public function addAction($string)
    {
        $logger = $this->get('logger');
        $logger->error($string);

        return new JsonResponse(array('string' => $string));


    }

    /**
     * Lists all Logs entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DomotiquebundleModuleBundle:Logs')->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('DomotiquebundleModuleBundle:Logs:index.html.twig', array(
            'pagination' => $pagination,
        ));
    }

    /**
     * Finds and displays a Logs entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiquebundleModuleBundle:Logs')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Logs entity.');
        }

        return $this->render('DomotiquebundleModuleBundle:Logs:show.html.twig', array(
            'entity' => $entity,
        ));
    }
    /**
     * Deletes a Logs entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiquebundleModuleBundle:Logs')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Logs entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_domotique_module_logs'));
    }
}
