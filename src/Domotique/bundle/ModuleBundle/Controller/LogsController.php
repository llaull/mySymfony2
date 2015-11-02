<?php

namespace Domotique\bundle\ModuleBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Domotique\bundle\ModuleBundle\Entity\Logs;

/**
 * Logs controller.
 *
 */
class LogsController extends Controller
{

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

        return $this->render('DomotiquebundleModuleBundle:Logs:index.html.twig', array(
            'entities' => $entities,
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
}
