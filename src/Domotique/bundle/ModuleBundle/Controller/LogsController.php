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


//    $entities = array(
//    array("heure"=> "2014", "label"=> "s", "moyenne"=> "50",  "maxi"=> "90", "mini"=> "10"),
//    array("heure"=> "2015", "label"=> "s", "moyenne"=> "65",  "maxi"=> "75", "mini"=> "55"),
//    array("heure"=> "2016", "label"=> "s", "moyenne"=> "50",  "maxi"=> "50", "mini"=> "10"),
//    array("heure"=> "2017", "label"=> "s", "moyenne"=> "75",  "maxi"=> "60", "mini"=> "35"),
//    array("heure"=> "2018", "label"=> "s", "moyenne"=> "80",  "maxi"=> "65", "mini"=> "20"),
//    array("heure"=> "2019", "label"=> "s", "moyenne"=> "90",  "maxi"=> "70", "mini"=> "10"),
//    array("heure"=> "2020", "label"=> "s", "moyenne"=> "100", "maxi"=> "75", "mini"=> "80"),
//    array("heure"=> "2021", "label"=> "s", "moyenne"=> "115", "maxi"=> "75", "mini"=> "61"),
//    array("heure"=> "2022", "label"=> "s", "moyenne"=> "120", "maxi"=> "85", "mini"=> "52"),
//    array("heure"=> "2023", "label"=> "s", "moyenne"=> "145", "maxi"=> "85", "mini"=> "45"),
//    array("heure"=> "2024", "label"=> "s", "moyenne"=> "160", "maxi"=> "95", "mini"=> "100")
//);


        return new JsonResponse($entities);
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
