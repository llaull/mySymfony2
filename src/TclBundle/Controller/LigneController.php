<?php

namespace TclBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TclBundle\Entity\Ligne;
use TclBundle\Form\LigneType;

/**
 * Ligne controller.
 *
 */
class LigneController extends Controller
{

    /**
     * Lists all Ligne entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('TclBundle:Ligne')->findAll();

        return $this->render('TclBundle:Ligne:index.html.twig', array(
            'pagination' => $entities,
        ));
    }

    /**
     * Creates a new Ligne entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Ligne();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_ligne_show', array('id' => $entity->getId())));
        }

        return $this->render('TclBundle:Ligne:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Ligne entity.
     *
     * @param Ligne $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Ligne $entity)
    {
        $form = $this->createForm(new LigneType(), $entity, array(
            'action' => $this->generateUrl('admin_ligne_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Ligne entity.
     *
     */
    public function newAction()
    {
        $entity = new Ligne();
        $form = $this->createCreateForm($entity);

        return $this->render('TclBundle:Ligne:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Ligne entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TclBundle:Ligne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ligne entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TclBundle:Ligne:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Ligne entity.
     *
     * @param Ligne $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Ligne $entity)
    {
        $form = $this->createForm(new LigneType(), $entity, array(
            'action' => $this->generateUrl('admin_ligne_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Ligne entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TclBundle:Ligne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ligne entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_ligne'));
        }

        return $this->render('TclBundle:Ligne:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Ligne entity.
     *
     */
    public function deleteAction(Ligne $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TclBundle:Ligne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ligne entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_ligne'));
    }

    /**
     * Creates a form to delete a Ligne entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_ligne_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
