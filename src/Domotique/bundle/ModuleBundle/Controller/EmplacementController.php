<?php

namespace Domotique\bundle\ModuleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Domotique\bundle\ModuleBundle\Entity\Emplacement;
use Domotique\bundle\ModuleBundle\Form\EmplacementType;

/**
 * Emplacement controller.
 *
 */
class EmplacementController extends Controller
{

    /**
     * Lists all Emplacement entities.
     *
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $rep= $em->getRepository('DomotiquebundleModuleBundle:Emplacement')
            ->createQueryBuilder('l');

//        var_dump($rep->getQuery()->getDql());
        $entities=$rep->getQuery()->getResult();

        $delete_forms  = array_map(
            function($element){
                return $this->createDeleteForm($element->getId());
            }
            ,$entities->toArray()
        );

        return $this->render('DomotiquebundleModuleBundle:Emplacement:index.html.twig'
            , array(
                'pagination'        => $entities,
                'delete_forms'    => $delete_forms
            ));


    }
    /**
     * Creates a new Emplacement entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Emplacement();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_domotique_module_emplacement'));
        }

        return $this->render('DomotiquebundleModuleBundle:Emplacement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Emplacement entity.
     *
     * @param Emplacement $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Emplacement $entity)
    {
        $form = $this->createForm(new EmplacementType(), $entity, array(
            'action' => $this->generateUrl('admin_domotique_module_emplacement_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Emplacement entity.
     *
     */
    public function newAction()
    {
        $entity = new Emplacement();
        $form   = $this->createCreateForm($entity);

        return $this->render('DomotiquebundleModuleBundle:Emplacement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Emplacement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiquebundleModuleBundle:Emplacement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Emplacement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DomotiquebundleModuleBundle:Emplacement:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Emplacement entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiquebundleModuleBundle:Emplacement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Emplacement entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DomotiquebundleModuleBundle:Emplacement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Emplacement entity.
    *
    * @param Emplacement $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Emplacement $entity)
    {
        $form = $this->createForm(new EmplacementType(), $entity, array(
            'action' => $this->generateUrl('admin_domotique_module_emplacement_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Emplacement entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiquebundleModuleBundle:Emplacement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Emplacement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_domotique_module_emplacement_edit', array('id' => $id)));
        }

        return $this->render('DomotiquebundleModuleBundle:Emplacement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Emplacement entity.
     *
     */
   /* public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DomotiquebundleModuleBundle:Emplacement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Emplacement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_domotique_module_emplacement'));
    }*/


    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('DomotiquebundleModuleBundle:Emplacement')
                ->find($id);
            // this line might need to be changed to point to the proper repository

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Emplacement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_domotique_module_emplacement'));
        // this line might need to be changed to point to the proper
        // post-delete route
    }


    /**
     * Creates a form to delete a Emplacement entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {

        return $this->createFormBuilder(array('id' => $id))
        ->add('id', 'hidden')
        ->getForm()
    ;

        /*return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_domotique_module_emplacement_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;*/
    }
}
