<?php


namespace CarnetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function menuAction()
    {
        $em = $this->getDoctrine()->getManager();

        $links = $em->getRepository('CarnetsBundle:GeneralTexte')->findBy(
            array('useInMenu' => "1"),
            array('title' => 'ASC'));

        if (!$links) {
            throw $this->createNotFoundException('Unable to find GeneralTexte entity.');
        }

        return $this->container->get('templating')->renderResponse('CarnetsBundle:Default:menu.html.twig', array(
            'links' => $links
        ));
    }

    /**
     * @param null $carnet
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function carnetMenuAction($carnet = null)
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

        return $this->container->get('templating')->renderResponse('CarnetsBundle:Carnet:menu.html.twig', array(
            'carnet' => $entity,
            'lieu' => $lieux,
            'page' => $pages,
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function footerAction()
    {
        $em = $this->getDoctrine()->getManager();

        $links = $em->getRepository('CarnetsBundle:GeneralTexte')->findBy(
            array('useInMenu' => "1"),
            array('ordre' => 'ASC'));

        $footerTexte = $em->getRepository('CarnetsBundle:GeneralTexte')->findByTitle("footer");

        $tagLieu = $em->getRepository('CarnetsBundle:Lieu')->tagAll();

        if (!$links) {
            throw $this->createNotFoundException('Unable to find GeneralTexte entity.');
        }

        if (!$footerTexte) {
            $footerTexte = array(array("contenu" => "footer à remplir"));
        }

        return $this->container->get('templating')->renderResponse('CarnetsBundle:Default:footer.html.twig', array(
            'links' => $links,
            'footerTexte' => current($footerTexte),
            'tag' => $tagLieu,

        ));
    }
}
