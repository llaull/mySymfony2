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
	   	return $this->render('CommunUserBundle:Default:bootstrap.html.twig',  array('user' => $user));
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
