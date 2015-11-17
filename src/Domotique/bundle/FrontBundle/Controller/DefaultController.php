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


    public function getModuleColorAction(Request $request)
    {
        $data = $request->request->get('data');
        $curling = $this->container->get('commun.curl');
        $em = $this->getDoctrine()->getManager();
        $params = json_decode($data);

        /*$entity = $em->getRepository('DomotiquebundleModuleBundle:Infos')->findOneById($params[0]->module);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find module entity.');
        }
*/
        $module_url = "http://" . '127.0.0.1' . "/" . "index.php"  ;
//        $module_url = "http://" . '127.0.0.1' . "/" . "color/54544554"  ;
    /*    //$module_url = "http://" . $entity->getNrfId() ;
        $module_url = "http://" . $entity->getNrfId() . "/" . $params[1]->path . "/" . $params[2]->color;


        if (!$this->isGranted("ROLE_ADMIN", NULL)) {
            return new JsonResponse(array('string' => 'nop'));
        } else {
*/
            $curl = $curling->getToUrl($module_url, false);
            return new JsonResponse(array('curl' => $curl));
//            return new JsonResponse(array('string' => 'ok', 'curl' => $curl, 'data' => $data));
      //  }

    }

    public function proxyAction(Request $request)
    {
        // Forbid every request but jquery's XHR
        if (!$request->isXmlHttpRequest()) {// isn't it an Ajax request?
            return new Response('', 404,
                array('Content-Type' => 'application/json'));
        }

        $restUrl = $request->request->get('restUrl');
        $method = $request->request->get('method');
        $params = $request->request->get('params');
        $contentType = $request->request->get('contentType');

        if ($contentType == null) {
            $contentType = 'application/json';
        }

        if ($restUrl == null || $method == null ||
            !in_array($method, array('GET', 'POST', 'DELETE'))) {
            return new Response('', 404, array('Content-Type' => $contentType));
        }

        session_write_close();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $restUrl);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if ($params != null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $requestCookies = $request->cookies->all();

        $cookieArray = array();
        foreach ($requestCookies as $cookieName => $cookieValue) {
            $cookieArray[] = "{$cookieName}={$cookieValue}";
        }
        $cookie_string = implode('; ', $cookieArray);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie_string);

        $response = curl_exec($ch);
        curl_close($ch);
        die(var_dump($response));

        list($headers, $response) = explode("\r\n\r\n",$response,2);
        preg_match_all('/Set-Cookie: (.*)\b/', $headers, $cookies);
        $cookies = $cookies[1];

        if ($response === false) {
            return new Response('', 404, array('Content-Type' => $contentType));
        } else {
            $response = new Response($response, 200,
                array('Content-Type' => $contentType));
            foreach($cookies as $rawCookie) {
                $cookie = \Symfony\Component\BrowserKit\Cookie::fromString($rawCookie);
                $value = $cookie->getValue();
                if (!empty($value)) {
                    $value = str_replace(' ', '+', $value);
                }
                $customCookie = new Cookie($cookie->getName(), $value, $cookie->getExpiresTime()==null?0:$cookie->getExpiresTime(), $cookie->getPath());
                $response->headers->setCookie($customCookie);
            }
            return $response;
        }
    }
}
