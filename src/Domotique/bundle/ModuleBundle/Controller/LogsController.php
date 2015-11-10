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
        //get @
        // domotiques/5-2-1-55
        $data = explode("-", $string);

        $now = new \DateTime();

        $stmt = $this->getDoctrine()->getEntityManager()
            ->getConnection()
            ->prepare('INSERT INTO `domotique__module_logs` (`id`, `modules_id`, `sonde_type`, `sonde_unit`, `sonde_valeur`, `sonde_id`, `temps`)
                VALUES (NULL, :modules_id, :sonde_type, :sonde_unit, :sonde_valeur, :sonde_id, :temps);');
        $stmt->bindValue('modules_id', $data[0]);
        $stmt->bindValue('sonde_type', $data[1]);
        $stmt->bindValue('sonde_unit', $data[2]);
        $stmt->bindValue('sonde_valeur', $data[3]);
        $stmt->bindValue('sonde_id', NULL);
        $stmt->bindValue('temps', $now->format('Y-m-d H:i:s'));
        $stmt->execute();

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

        $this->get('ras_flash_alert.alert_reporter')->addError("suppression ok");

//        $this->addFlash(
//            'notice',
//            'Your changes were saved!'
//        );

        return $this->redirect($this->generateUrl('admin_domotique_module_logs'));
    }
}
