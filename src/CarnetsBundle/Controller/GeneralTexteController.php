<?php

namespace CarnetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CarnetsBundle\Entity\GeneralTexte;
use CarnetsBundle\Form\GeneralTexteType;

/**
 * GeneralTexte controller.
 *
 */
class GeneralTexteController extends Controller
{

    public function orderAction(Request $request)
    {

        $data = $request->request->get('data');
        $params = json_decode($data);
        $em = $this->getDoctrine()->getManager();

        //met tout a null
        $q = $em->createQuery('update CarnetsBundle:GeneralTexte c set c.ordre = 1');
        $q->execute();


        foreach ($params as $v) {
                $em = $this->getDoctrine()->getManager();

                $entity = $em->getRepository('CarnetsBundle:GeneralTexte')->find($v->id);

                if (!$entity) {
                    throw $this->createNotFoundException('Unable to find GeneralTexte entity.');
                }

                $entity->setOrdre($v->order);
                $em->flush();
        }
        die();

    }

    /**
     * Lists all GeneralTexte entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CarnetsBundle:GeneralTexte')->findAll();

        return $this->render('CarnetsBundle:GeneralTexte:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new GeneralTexte entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new GeneralTexte();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_general_texte'));
        }

        return $this->render('CarnetsBundle:GeneralTexte:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a GeneralTexte entity.
     *
     * @param GeneralTexte $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(GeneralTexte $entity)
    {
        $form = $this->createForm(new GeneralTexteType(), $entity, array(
            'action' => $this->generateUrl('admin_general_texte_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new GeneralTexte entity.
     *
     */
    public function newAction()
    {
        $entity = new GeneralTexte();
        $form = $this->createCreateForm($entity);

        return $this->render('CarnetsBundle:GeneralTexte:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a GeneralTexte entity.
     *
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:GeneralTexte')->findOneBySlug($slug);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GeneralTexte entity.');
        }

        return $this->render('CarnetsBundle:GeneralTexte:show.html.twig', array(
            'GeneralTexte' => $entity
        ));
    }

    /**
     * Displays a form to edit an existing GeneralTexte entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:GeneralTexte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GeneralTexte entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CarnetsBundle:GeneralTexte:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a GeneralTexte entity.
     *
     * @param GeneralTexte $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(GeneralTexte $entity)
    {
        $form = $this->createForm(new GeneralTexteType(), $entity, array(
            'action' => $this->generateUrl('admin_general_texte_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing GeneralTexte entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:GeneralTexte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GeneralTexte entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_general_texte_edit', array('id' => $id)));
        }

        return $this->render('CarnetsBundle:GeneralTexte:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a GeneralTexte entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:GeneralTexte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carnet entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_general_texte'));
    }

    /**
     * Creates a form to delete a GeneralTexte entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_general_texte_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
