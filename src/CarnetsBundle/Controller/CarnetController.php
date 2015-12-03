<?php

namespace CarnetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CarnetsBundle\Entity\Carnet;
use CarnetsBundle\Form\CarnetType;

use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Carnet controller.
 *
 */
class CarnetController extends Controller
{


    /**
     * dessine le chemin du voyage
     *
     */
    public function pathAction()
    {

        $array = array(
//            array("title"=>"Bordeaux","latitude"=>"44.83059350000001","longitude"=>"-0.7103051999999934", "color" => "#77bf44"),
//            array("title"=>"Paris","latitude"=>"48.856614","longitude"=>"2.3522219000000177", "color" => "#77bf44"),

        //exemple
//        $sua =
//            array("USA"=> array(
//            array("title"=>"Paris","latitude"=>"33.7490","longitude"=>"-84.3880", "color" => "#77bf44"),
//            array("title"=>"Paris","latitude"=>"33.4484","longitude"=>"-112.0740", "color" => "#77bf44"),
//            array("title"=>"Paris","latitude"=>"37.9577","longitude"=>"-121.2908", "color" => "#77bf44")
//            )
//            ),
        //exemple

//        $asie =
//            array("asie"=> array(
            array("title"=>"Hong Kong","latitude"=>"22.308047","longitude"=>"113.9184808", "color" => "#77bf44"),
            array("title"=>"Hanoï","latitude"=>"21.0277644","longitude"=>"105.83415979999995", "color" => "#77bf44"),
            array("title"=>"Nha Trang","latitude"=>"12.2387911","longitude"=>"109.19674880000002", "color" => "#77bf44"),
            array("title"=>"Hô-Chi-Minh-Ville","latitude"=>"10.8230989","longitude"=>"106.6296638", "color" => "#77bf44"),
            array("title"=>"Bangkok","latitude"=>"13.7563309","longitude"=>"100.50176510000006", "color" => "#77bf44"),
            array("title"=>"Phuket","latitude"=>"7.9519331","longitude"=>"98.33808840000006", "color" => "#77bf44")
//            )
//            )
    );

//        $array =  json_encode( array_combine( $sua, $asie ) );
//echo $array;
//        die(var_dump($array));

//        $array = array_merge($sua, $asie);
//        die(var_dump($array));
        return new JsonResponse(array('path' => $array));
    }

    /**
     * Lists all Carnet entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CarnetsBundle:Carnet')->findAll();


        return $this->render('CarnetsBundle:Carnet:index.html.twig', array(
            'pagination' => $entities,
        ));
    }

    /**
     * Creates a new Carnet entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Carnet();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();


            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_carnet'));
        }

        return $this->render('CarnetsBundle:Carnet:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Carnet entity.
     *
     * @param Carnet $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Carnet $entity)
    {
        $form = $this->createForm(new CarnetType(), $entity, array(
            'action' => $this->generateUrl('admin_carnet_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Carnet entity.
     *
     */
    public function newAction()
    {
        $entity = new Carnet();
        $form = $this->createCreateForm($entity);

        return $this->render('CarnetsBundle:Carnet:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Carnet entity.
     *
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:Carnet')
            ->findOneBy(array('slug' => $slug));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carnet entity.');
        }

        return $this->render('CarnetsBundle:Default:carnet.html.twig', array(
            'entity' => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing Carnet entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:Carnet')->find($id);

        $entitiesL = $em->getRepository('CarnetsBundle:Lieu')->findBy(
            array('carnet' => $entity),
            array('ordre' => 'ASC'));

        $entitiesP = $em->getRepository('CarnetsBundle:Page')->findBy(
            array('lieu' => $entitiesL),
            array('ordre' => 'ASC'));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carnet entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CarnetsBundle:Carnet:edit.html.twig', array(
            'entity' => $entity,
            'lieux' => $entitiesL,
            'pages' => $entitiesP,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Carnet entity.
     *
     * @param Carnet $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Carnet $entity)
    {
        $form = $this->createForm(new CarnetType(), $entity, array(
            'action' => $this->generateUrl('admin_carnet_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Carnet entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:Carnet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carnet entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_carnet_edit', array('id' => $id)));
        }

        return $this->render('CarnetsBundle:Carnet:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Carnet entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:Carnet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carnet entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_carnet'));
    }

    /**
     * Creates a form to delete a Carnet entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_carnet_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
