<?php

namespace Domotique\bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

use Domotique\bundle\ModuleBundle\Entity\Infos;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DomotiquebundleFrontBundle:Default:index.html.twig', array('name' => 'toi'));
    }


    public function getModuleColorAction(Request $request)
    {
        $data = $request->request->get('data');
        $curling = $this->container->get('commun.curl');
        $em = $this->getDoctrine()->getManager();
        $params = json_decode($data);

        $entity = $em->getRepository('DomotiquebundleModuleBundle:Infos')->findOneById($params[0]->module);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find module entity.');
        }

        //$module_url = "http://" . '127.0.0.1' . "/?" . "color=" . $params[1]->color;
        //$module_url = "http://" . $entity->getNrfId() ;
        $module_url = "http://" . $entity->getNrfId() . "/" . $params[1]->path . "/" . $params[2]->color;


        if (!$this->isGranted("ROLE_ADMIN", NULL)) {
            return new JsonResponse(array('string' => 'nop'));
        } else {

            $curl = $curling->getToUrl($module_url, false);
            return new JsonResponse(array('string' => 'ok', 'curl' => $curl, 'data' => $data));
        }

    }
}
