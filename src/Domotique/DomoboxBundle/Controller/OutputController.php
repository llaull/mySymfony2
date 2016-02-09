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
        $entities = $entities->moyenneByModuleBySondes($em);


//        $entities = array(
//            array("heure" => "2014", "label" => "s", "moyenne" => "50", "maxi" => "90", "mini" => "10"),
//            array("heure" => "2015", "label" => "s", "moyenne" => "65", "maxi" => "75", "mini" => "55"),
//            array("heure" => "2016", "label" => "s", "moyenne" => "50", "maxi" => "50", "mini" => "10"),
//            array("heure" => "2017", "label" => "s", "moyenne" => "75", "maxi" => "60", "mini" => "35"),
//            array("heure" => "2018", "label" => "s", "moyenne" => "80", "maxi" => "65", "mini" => "20"),
//            array("heure" => "2019", "label" => "s", "moyenne" => "90", "maxi" => "70", "mini" => "10"),
//            array("heure" => "2020", "label" => "s", "moyenne" => "100", "maxi" => "75", "mini" => "80"),
//            array("heure" => "2021", "label" => "s", "moyenne" => "115", "maxi" => "75", "mini" => "61"),
//            array("heure" => "2022", "label" => "s", "moyenne" => "120", "maxi" => "85", "mini" => "52"),
//            array("heure" => "2023", "label" => "s", "moyenne" => "145", "maxi" => "85", "mini" => "45"),
//            array("heure" => "2024", "label" => "s", "moyenne" => "160", "maxi" => "95", "mini" => "100")
//        );


        return new JsonResponse($entities);
    }
}