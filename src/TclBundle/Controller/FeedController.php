<?php

namespace TclBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TclBundle\Entity\Feed;

/**
 * Feed controller.
 *
 */
class FeedController extends Controller
{

    /**
     * Lists all Feed entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('TclBundle:Feed')->findAll();


        return $this->render('TclBundle:Feed:index.html.twig', array(
            'pagination' => $entities,
        ));
    }

    /**
     * Finds and displays a Feed entity.
     *
     */
    public function showAction($id)
    {
//        die(var_dump($id));
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('TclBundle:Feed')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Feed entity.');
            }

            return $this->render('TclBundle:Feed:show.html.twig', array(
                'entity' => $entity,
            ));
    }

    public function sshowAction($id)
    {
//        die(var_dump($id));

        return $view   = $this->showAction($id);

        return array(
            'entity' => $view,

        );

    }

}
