<?php


namespace CarnetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use CarnetsBundle\Entity\Carnet;

class MenuController extends Controller {

    function menuAction($carnet = null)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:Carnet')
            ->findOneBy(array('slug' => $carnet));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carnet entity.');
        }


        $l = $em->getRepository('CarnetsBundle:Lieu')->findByCarnet($entity);

        $p = $em->getRepository('CarnetsBundle:Page')->findByLieu($l);

        return $this->container->get('templating')->renderResponse('CarnetsBundle:Default:menu.html.twig', array(
            'lieu' => $l,
            'page' => $p,
        ));
    }
}