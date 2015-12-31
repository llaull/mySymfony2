<?php

namespace CarnetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use CarnetsBundle\Entity\Lieu;
use CarnetsBundle\Form\Type\LieuType;
/**
 * Lieu controller.
 *
 */
class LieuController extends Controller
{

    /**
     * Lists all lieu by carnet id
     *
     */
    public function getCarnetAction(Request $request)
    {
        $data = $request->request->get('data');

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('CarnetsBundle:Lieu')->findByCarnet($data);

        return new JsonResponse(array('lieu' => $entities));
    }

    /**
     * Lists all Lieu entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('CarnetsBundle:Lieu')->findAll();

        return $this->render('CarnetsBundle:Lieu:index.html.twig', array(
            'pagination' => $entities,
        ));
    }

    /**
     * Creates a new Lieu entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Lieu();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_lieu'));
           // return $this->redirect($this->generateUrl('admin_lieu_new'));
        }

        return $this->render('CarnetsBundle:Lieu:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Lieu entity.
     *
     * @param Lieu $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Lieu $entity)
    {
        $form = $this->createForm(new LieuType(), $entity, array(
            'action' => $this->generateUrl('admin_lieu_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Lieu entity.
     *
     */
    public function newAction()
    {
        $entity = new Lieu();
        $form = $this->createCreateForm($entity);

        return $this->render('CarnetsBundle:Lieu:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Page entity.
     *
     */
    public function showAction($carnet, $ville)
    {
        $em = $this->getDoctrine()->getManager();

        $carnetInfos = $em->getRepository('CarnetsBundle:Carnet')->findOneBySlug($carnet);

        $entity = $em->getRepository('CarnetsBundle:Lieu')->findOneBySlug($ville);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }
       // $slugCarnet = array("slug" => $carnet);

        return $this->render('CarnetsBundle:Page:show.html.twig', array(
            'entity' => $carnetInfos,
            'page' => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing Lieu entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:Lieu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lieu entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

//        die(var_dump($entity));

        return $this->render('CarnetsBundle:Lieu:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Lieu entity.
     *
     * @param Lieu $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Lieu $entity)
    {
        $form = $this->createForm(new LieuType(), $entity, array(
            'action' => $this->generateUrl('admin_lieu_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Lieu entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:Lieu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lieu entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_lieu_edit', array('id' => $id)));
        }

        return $this->render('CarnetsBundle:Lieu:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Lieu entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:Lieu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lieu entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_lieu'));
    }
    /**
     * Creates a form to delete a Lieu entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_lieu_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
