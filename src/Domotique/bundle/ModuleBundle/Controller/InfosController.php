<?php

namespace Domotique\bundle\ModuleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Domotique\bundle\ModuleBundle\Entity\Infos;
use Domotique\bundle\ModuleBundle\Form\InfosType;

/**
 * Infos controller.
 *
 */
class InfosController extends Controller
{

    /**
     * Lists all Infos entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DomotiquebundleModuleBundle:Infos')->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('DomotiquebundleModuleBundle:Infos:index.html.twig', array(
            'pagination' => $pagination,
        ));
    }
    /**
     * Creates a new Infos entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Infos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_domotique_module_infos'));
        }

        return $this->render('DomotiquebundleModuleBundle:Infos:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Infos entity.
     *
     * @param Infos $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Infos $entity)
    {
        $form = $this->createForm(new InfosType(), $entity, array(
            'action' => $this->generateUrl('admin_domotique_module_infos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Infos entity.
     *
     */
    public function newAction()
    {
        $entity = new Infos();
        $form   = $this->createCreateForm($entity);

        return $this->render('DomotiquebundleModuleBundle:Infos:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Infos entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiquebundleModuleBundle:Infos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Infos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DomotiquebundleModuleBundle:Infos:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Infos entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiquebundleModuleBundle:Infos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Infos entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DomotiquebundleModuleBundle:Infos:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Infos entity.
    *
    * @param Infos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Infos $entity)
    {
        $form = $this->createForm(new InfosType(), $entity, array(
            'action' => $this->generateUrl('admin_domotique_module_infos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Infos entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiquebundleModuleBundle:Infos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Infos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_domotique_module_infos_edit', array('id' => $id)));
        }

        return $this->render('DomotiquebundleModuleBundle:Infos:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Infos entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiquebundleModuleBundle:Infos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Infos entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_domotique_module_infos'));
    }
    /**
     * Creates a form to delete a Infos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_domotique_module_infos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
