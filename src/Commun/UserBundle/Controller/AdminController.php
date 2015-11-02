<?php

namespace Commun\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminController extends Controller{

    /*
     * @Route("/admin/")
      @Template("CommunUserBundle:Admin:bootstrap.html.twig")
     */
    public function indexAction()
    {

        $user = $this->container->get('security.context')->getToken()->getUser();
        return $this->render('CommunUserBundle:Admin:MainWrapper.html.twig', array('user' => $user));
    }


}