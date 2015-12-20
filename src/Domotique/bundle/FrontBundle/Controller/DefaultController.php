<?php

namespace Domotique\bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

use Domotique\bundle\ModuleBundle\Entity\Infos;



use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DomotiquebundleFrontBundle:Default:index.html.twig', array('name' => 'toi'));
    }

    public function debugAction()
    {

        $restClient = $this->container->get('ci.restclient');

        //$restClient->get('http://www.someUrl.com');

        try {
            $restClient->get('http://192.168.1.4/cl/s');
            var_dump($restClient);
        } catch (Ci\RestClientBundle\Exceptions\OperationTimedOutException $exception) {
            // do something
        }

        //$r = Request::create( 'http://10.0.112.4/ind?=sjj', 'GET' );
        //var_dump($r);

        die(var_dump("bl"));
    }

    public function getModuleColorAction(Request $request)
    {
        $data = $request->request->get('data');
        $curling = $this->container->get('commun.curl');
        $em = $this->getDoctrine()->getManager();
        $params = json_decode($data);
//die(var_dump($params));
        $entity = $em->getRepository('DomotiquebundleModuleBundle:Infos')->findOneById($params[0]->module);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find module entity.');
        }

       // $module_url = "http://192.168.1.4/color/8782255"  ;
//        $module_url = "http://" . '127.0.0.1' . "/" . "color/54544554"  ;
        //$module_url = "http://" . $entity->getNrfId() ;
        $module_url = "http://" . $entity->getNrfId() . "/" . $params[1]->path . "/" . $params[2]->color;

        //die(var_dump($module_url));

        if (!$this->isGranted("ROLE_ADMIN", NULL)) {
            return new JsonResponse(array('string' => 'nop'));
        } else {

            $curl = $curling->getToUrl($module_url, false);
            return new JsonResponse(array('curl' => $curl));
//            return new JsonResponse(array('string' => 'ok', 'curl' => $curl, 'data' => $data));
            //  }

        }
    }
}
