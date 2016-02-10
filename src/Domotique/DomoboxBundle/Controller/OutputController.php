<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 09/02/2016
 * Time: 16:32
 */

namespace Domotique\DomoboxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class OutputController extends Controller
{

    public function logMoyenneAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $entities = $this->getDoctrine()->getRepository('DomotiqueReseauBundle:Log');
        $entities = $entities->getMoyenHourGroupByModule($em, 1, 1);

        return new JsonResponse($entities);
    }
}