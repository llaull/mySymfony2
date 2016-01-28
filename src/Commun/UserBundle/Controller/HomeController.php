<?php

namespace Commun\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {

        $user = $this->container->get('security.context')->getToken()->getUser();
        $host = $this->container->get('request')->getHost();

        switch ($host) {
            case $this->getParameter('app_host');
                return $this->redirect($this->generateUrl($this->getParameter('app_route')));
                break;
            default:
                return $this->render('CommunUserBundle:Default:bootstrap.html.twig',  array('user' => $user));
        }

    }

    /**
     * Displays a form to create a new Post entity.
     * @Route("/new", name="admin_post_new")
//     *
     */
    public function newAction()
    {
        // ...@Security("has_role('ROLE_ADMIN')")
    }
}
