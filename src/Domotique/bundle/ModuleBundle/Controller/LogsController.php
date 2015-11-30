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
        // m/g/5-2-1-55
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

        return $this->render('DomotiquebundleModuleBundle:Logs:index.html.twig', array(
            'pagination' => $entities,
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

        return $this->redirect($this->generateUrl('admin_domotique_module_logs'));
    }

    /**
     * truncate la table logs
     *
     */
    public function truncateAction()
    {

        $stmt = $this->getDoctrine()->getEntityManager()
            ->getConnection()
            ->prepare('TRUNCATE domotique__module_logs;');

        $stmt->execute();

        $this->get('ras_flash_alert.alert_reporter')->addSuccess("TRUNCATE ok");

        return $this->redirect($this->generateUrl('admin_domotique_module_logs'));
    }

    /**
     *
     */
    public function logMoyenneAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $entities = $this->getDoctrine()->getRepository('DomotiquebundleModuleBundle:Logs');
        $entities = $entities->moyenneByModuleBySondes($em);

        return new JsonResponse(array('sondes' => $entities));
    }

    /**
     *
     */
    public function logMoyenneBisAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $entities = $this->getDoctrine()->getRepository('DomotiquebundleModuleBundle:Logs');
        $entities = $entities->moyenneByModuleBySondesBis($em);

        return new JsonResponse(array('name' => $entities));
    }
}
