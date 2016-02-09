<?php

namespace Domotique\DomoboxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Domotique\ReseauBundle\Entity\Log;
use Domotique\ReseauBundle\Entity\Module;

class InputController extends Controller
{
    public function addJsonAction()
    {
        $em = $this->getDoctrine()->getManager();
        $params = array();
        $logger = $this->get('logger');
        $content = $this->get("request")->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true); // 2nd param to get as array
        }
        //recherche module
        $moduleX = $em->getRepository('DomotiqueReseauBundle:Module')
            ->findOneBy(array('adressMac' => $params['mac']));
        if (!$moduleX) {
            $logger->error("Unable to find module entity.");
//
            $module = new Module();
            $module->setId(NULL);
            $module->setAdressMac($params['mac']);
            $module->setAdressIpv4($params['ipv4']);
//
            $em->persist($module);
            $em->flush();
        } else {
            $logger->error("ok !");
            foreach ($params['sensors'] as $k => $v) {
                $log = new Log();
                $SondeType = $em->getRepository('DomotiqueReseauBundle:SondeType')->find($params['sensors'][$k]['sensor type Id']);
                $SondeUnit = $em->getRepository('DomotiqueReseauBundle:SondeUnit')->find($params['sensors'][$k]['sensor unit Id']);
                $log->setModule($moduleX);
                $log->setSensorId($params['sensors'][$k]['sensor Id']);
                $log->setSensorType($SondeType);
                $log->setSensorUnit($SondeUnit);
                $log->setSonsorValue($params['sensors'][$k]['sensor value']);
                $em->persist($log);
            }
            $em->flush();
        }
        return new JsonResponse(array('requete' => "sucess"));
    }
}
