<?php

namespace Domotique\ReseauBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Domotique\ReseauBundle\Entity\SondeType;
use Domotique\ReseauBundle\Form\SondeTypeType;

/**
 * SondeType controller.
 *
 */
class SondeTypeController extends Controller
{

    /**
     * Lists all SondeType entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DomotiqueReseauBundle:SondeType')->findAll();

        return $this->render('DomotiqueReseauBundle:SondeType:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SondeType entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SondeType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_sensor_type__show', array('id' => $entity->getId())));
        }

        return $this->render('DomotiqueReseauBundle:SondeType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SondeType entity.
     *
     * @param SondeType $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SondeType $entity)
    {
        $form = $this->createForm(new SondeTypeType(), $entity, array(
            'action' => $this->generateUrl('admin_sensor_type__create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SondeType entity.
     *
     */
    public function newAction()
    {
        $entity = new SondeType();
        $form   = $this->createCreateForm($entity);

        return $this->render('DomotiqueReseauBundle:SondeType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SondeType entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiqueReseauBundle:SondeType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SondeType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DomotiqueReseauBundle:SondeType:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SondeType entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiqueReseauBundle:SondeType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SondeType entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DomotiqueReseauBundle:SondeType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SondeType entity.
    *
    * @param SondeType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SondeType $entity)
    {
        $form = $this->createForm(new SondeTypeType(), $entity, array(
            'action' => $this->generateUrl('admin_sensor_type__update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SondeType entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiqueReseauBundle:SondeType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SondeType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_sensor_type__edit', array('id' => $id)));
        }

        return $this->render('DomotiqueReseauBundle:SondeType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SondeType entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DomotiqueReseauBundle:SondeType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SondeType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_sensor_type_'));
    }

    /**
     * Creates a form to delete a SondeType entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_sensor_type__delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}