<?php

namespace CarnetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CarnetsBundle\Entity\Page;
use CarnetsBundle\Form\PageType;

/**
 * Page controller.
 *
 */
class PageController extends Controller
{


    public function orderAction(Request $request)
    {

        $data = $request->request->get('data');
        $params = json_decode($data);
        $em = $this->getDoctrine()->getManager();

        //met tout a null
        $q = $em->createQuery('update CarnetsBundle:Lieu c set c.ordre = 1');
        $q->execute();
        $q = $em->createQuery('update CarnetsBundle:Page c set c.ordre = 1');
        $q->execute();

        var_dump($params);

        foreach ($params as $v) {
            if ($v->type != "lieu") {
                $em = $this->getDoctrine()->getManager();

                $entity = $em->getRepository('CarnetsBundle:Page')->find($v->id);

                if (!$entity) {
                    throw $this->createNotFoundException('Unable to find Page entity.');
                }

                $entity->setOrdre($v->order);
                $em->flush();
            } else {
                $em = $this->getDoctrine()->getManager();

                $entity = $em->getRepository('CarnetsBundle:Lieu')->find($v->id);

                if (!$entity) {
                    throw $this->createNotFoundException('Unable to find Lieu entity.');
                }

                $entity->setOrdre($v->order);
                $em->flush();
            }

        }
        die();

    }

    /**
     * Lists all Page entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CarnetsBundle:Page')->findAll();

        return $this->render('CarnetsBundle:Page:index.html.twig', array(
            'pagination' => $entities,
        ));
    }

    /**
     * Creates a new Page entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Page();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_page'));
        }

        return $this->render('CarnetsBundle:Page:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Page entity.
     *
     * @param Page $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Page $entity)
    {
        $form = $this->createForm(new PageType(), $entity, array(
            'action' => $this->generateUrl('admin_page_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Page entity.
     *
     */
    public function newAction()
    {
        $entity = new Page();
        $form = $this->createCreateForm($entity);

        return $this->render('CarnetsBundle:Page:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Page entity.
     *
     */
    public function showAction($carnet, $page)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:Page')->findOneBySlug($page);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }
        $slugCarnet = array("slug" => $carnet);

        return $this->render('CarnetsBundle:Default:page.html.twig', array(
            'entity' => $slugCarnet,
            'page' => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing Page entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CarnetsBundle:Page:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Page entity.
     *
     * @param Page $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Page $entity)
    {
        $form = $this->createForm(new PageType(), $entity, array(
            'action' => $this->generateUrl('admin_page_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Page entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_page_edit', array('id' => $id)));
        }

        return $this->render('CarnetsBundle:Page:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Page entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_page'));
    }

    /**
     * Creates a form to delete a Page entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_page_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
