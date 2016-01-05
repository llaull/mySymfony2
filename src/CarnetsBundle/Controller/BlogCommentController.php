<?php

namespace CarnetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CarnetsBundle\Entity\BlogComment;
use CarnetsBundle\Form\Type\BlogCommentType;

/**
 * BlogComment controller.
 *
 */
class BlogCommentController extends Controller
{

    /**
     * Lists all BlogComment entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CarnetsBundle:BlogComment')->findAll();

        return $this->render('CarnetsBundle:BlogComment:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new BlogComment entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new BlogComment();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_carnet_blog_comment_show', array('id' => $entity->getId())));
        }

        return $this->render('CarnetsBundle:BlogComment:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a BlogComment entity.
     *
     * @param BlogComment $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(BlogComment $entity)
    {
        $form = $this->createForm(new BlogCommentType(), $entity, array(
            'action' => $this->generateUrl('admin_carnet_blog_comment_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BlogComment entity.
     *
     */
    public function newAction($article)
    {
        $em = $this->getDoctrine()->getManager();
        $articleCurrent = $em->getRepository('CarnetsBundle:BlogArticle')->findById($article);


//        var_dump($articleCurrent);
        $entity = new BlogComment();
        $entity->setArcticle($articleCurrent);
        $form   = $this->createCreateForm($entity);

        return $this->render('CarnetsBundle:BlogComment:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a BlogComment entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:BlogComment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogComment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CarnetsBundle:BlogComment:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BlogComment entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:BlogComment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogComment entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CarnetsBundle:BlogComment:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a BlogComment entity.
    *
    * @param BlogComment $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BlogComment $entity)
    {
        $form = $this->createForm(new BlogCommentType(), $entity, array(
            'action' => $this->generateUrl('admin_carnet_blog_comment_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing BlogComment entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:BlogComment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogComment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_carnet_blog_comment_edit', array('id' => $id)));
        }

        return $this->render('CarnetsBundle:BlogComment:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a BlogComment entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CarnetsBundle:BlogComment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BlogComment entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_carnet_blog_comment'));
    }

    /**
     * Creates a form to delete a BlogComment entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_carnet_blog_comment_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
