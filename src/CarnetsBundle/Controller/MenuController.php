<?php


namespace CarnetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller {

    function menuAction($carnet = null)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:Carnet')
            ->findOneBy(array('slug' => $carnet));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carnet entity.');
        }

        $lieux = $em->getRepository('CarnetsBundle:Lieu')->findBy(
            array('carnet' => $entity, 'useInMenu' => "1"),
            array('ordre' => 'ASC'));

        $pages = $em->getRepository('CarnetsBundle:Page')->findBy(
            array('lieu' => $lieux),
            array('ordre' => 'ASC'));

        return $this->container->get('templating')->renderResponse('CarnetsBundle:Default:menu.html.twig', array(
            'carnet' => $entity,
            'lieu' => $lieux,
            'page' => $pages,
        ));
    }

    function footerAction()
    {
        $em = $this->getDoctrine()->getManager();

        $links = $em->getRepository('CarnetsBundle:GeneralTexte')->findBy(
            array('useInMenu' => "1"),
            array('title' => 'ASC'));

        if (!$links) {
            throw $this->createNotFoundException('Unable to find GeneralTexte entity.');
        }

        return $this->container->get('templating')->renderResponse('CarnetsBundle:Default:footer.html.twig', array(
            'links' => $links

        ));
    }
}