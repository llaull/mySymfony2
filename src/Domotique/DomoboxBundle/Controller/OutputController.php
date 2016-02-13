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
        $entities = $entities->getMoyenHourGroupByModule($em, 1, 2);

        return new JsonResponse($entities);
    }

    public function getCurrentDateAction(){
        $now = new \DateTime();
        $currentDate = $now->format('d-m-Y G:i:s');

        $return = array("time" => $currentDate);
        return new JsonResponse($return);
    }

    public function getCurrentTemp(){

    }
}
