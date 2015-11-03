<?php

namespace Domotique\bundle\ModuleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Domotique\bundle\ModuleBundle\Entity\SondeUnit;
use Domotique\bundle\ModuleBundle\Form\SondeUnitType;

/**
 * SondeUnit controller.
 *
 */
class SondeUnitController extends Controller
{

    /**
     * Lists all SondeUnit entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DomotiquebundleModuleBundle:SondeUnit')->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('DomotiquebundleModuleBundle:SondeUnit:index.html.twig', array(
            'pagination' => $pagination,
        ));
    }
    /**
     * Creates a new SondeUnit entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SondeUnit();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_domotique_module_sonde_unit'));
        }

        return $this->render('DomotiquebundleModuleBundle:SondeUnit:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SondeUnit entity.
     *
     * @param SondeUnit $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SondeUnit $entity)
    {
        $form = $this->createForm(new SondeUnitType(), $entity, array(
            'action' => $this->generateUrl('admin_domotique_module_sonde_unit_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SondeUnit entity.
     *
     */
    public function newAction()
    {
        $entity = new SondeUnit();
        $form   = $this->createCreateForm($entity);

        return $this->render('DomotiquebundleModuleBundle:SondeUnit:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SondeUnit entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiquebundleModuleBundle:SondeUnit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SondeUnit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DomotiquebundleModuleBundle:SondeUnit:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SondeUnit entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiquebundleModuleBundle:SondeUnit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SondeUnit entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DomotiquebundleModuleBundle:SondeUnit:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SondeUnit entity.
    *
    * @param SondeUnit $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SondeUnit $entity)
    {
        $form = $this->createForm(new SondeUnitType(), $entity, array(
            'action' => $this->generateUrl('admin_domotique_module_sonde_unit_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SondeUnit entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiquebundleModuleBundle:SondeUnit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SondeUnit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_domotique_module_sonde_unit_edit', array('id' => $id)));
        }

        return $this->render('DomotiquebundleModuleBundle:SondeUnit:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SondeUnit entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiquebundleModuleBundle:SondeUnit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SondeUnit entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_domotique_module_sonde_unit'));
    }
    /**
     * Creates a form to delete a SondeUnit entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_domotique_module_sonde_unit_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
