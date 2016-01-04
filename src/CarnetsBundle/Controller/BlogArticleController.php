<?php

namespace CarnetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CarnetsBundle\Entity\BlogArticle;
use CarnetsBundle\Form\Type\BlogArticleType;

/**
 * BlogArticle controller.
 *
 */
class BlogArticleController extends Controller
{

    /**
     * Lists all BlogArticle entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CarnetsBundle:BlogArticle')->findAll();

        return $this->render('CarnetsBundle:BlogArticle:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new BlogArticle entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new BlogArticle();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_carnet_blog_article_show', array('id' => $entity->getId())));
        }

        return $this->render('CarnetsBundle:BlogArticle:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a BlogArticle entity.
     *
     * @param BlogArticle $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(BlogArticle $entity)
    {
        $form = $this->createForm(new BlogArticleType(), $entity, array(
            'action' => $this->generateUrl('admin_carnet_blog_article_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BlogArticle entity.
     *
     */
    public function newAction()
    {
        $entity = new BlogArticle();
        $form   = $this->createCreateForm($entity);

        return $this->render('CarnetsBundle:BlogArticle:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a BlogArticle entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:BlogArticle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogArticle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CarnetsBundle:BlogArticle:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BlogArticle entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:BlogArticle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogArticle entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CarnetsBundle:BlogArticle:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a BlogArticle entity.
    *
    * @param BlogArticle $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BlogArticle $entity)
    {
        $form = $this->createForm(new BlogArticleType(), $entity, array(
            'action' => $this->generateUrl('admin_carnet_blog_article_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing BlogArticle entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetsBundle:BlogArticle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogArticle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_carnet_blog_article_edit', array('id' => $id)));
        }

        return $this->render('CarnetsBundle:BlogArticle:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a BlogArticle entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CarnetsBundle:BlogArticle')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BlogArticle entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_carnet_blog_article'));
    }

    /**
     * Creates a form to delete a BlogArticle entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_carnet_blog_article_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
