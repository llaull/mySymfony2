<?php

namespace Domotique\ReseauBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Domotique\ReseauBundle\Entity\Log;
use Domotique\ReseauBundle\Form\LogType;

/**
 * Log controller.
 *
 */
class LogController extends Controller
{

    public function addJsonAction()
    {
        $em = $this->getDoctrine()->getManager();
        $params = array();
        $logger = $this->get('logger');
        $content = $this->get("request")->getContent();
        if (!empty($content)) {
            $params = json_decode($content, true); // 2nd param to get as array
        }
        //recherche module
        $moduleX = $em->getRepository('DomotiqueReseauBundle:Module')
            ->findOneBy(array('adressMac' => $params['mac']));
        $logger->error($moduleX->getId());
        $logger->error($params['mac']);
        if (!$moduleX) {
            $logger->error("Unable to find module entity.");
//
            $module = new Module();
            $module->setId(NULL);
            $module->setAdressMac($params['mac']);
            $module->setAdressIpv4($params['ipv4']);
//
            $em->persist($module);
            $em->flush();
        } else {
            $logger->error("ok !");
            foreach ($params['sensors'] as $k => $v) {
                $log = new Log();
                // $module = $em->getRepository('DomotiquebundleModuleBundle:Infos')->find(1);
                $SondeType = $em->getRepository('DomotiqueReseauBundle:SondeType')->find($params['sensors'][$k]['sensor type Id']);
                $SondeUnit = $em->getRepository('DomotiqueReseauBundle:SondeUnit')->find($params['sensors'][$k]['sensor unit Id']);
                $log->setModules($moduleX);
                $log->setSondeId($params['sensors'][$k]['sensor Id']);
                $log->setSondeType($SondeType);
                $log->setSondeUnit($SondeUnit);
                $log->setSondeValeur($params['sensors'][$k]['sensor value']);
                $em->persist($log);
            }
            $em->flush();
        }
        return new JsonResponse(array('requete' => "sucess"));
    }
    /**
     * Lists all Log entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DomotiqueReseauBundle:Log')->findAll();

        return $this->render('DomotiqueReseauBundle:Log:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Log entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Log();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_sensor_log_show', array('id' => $entity->getId())));
        }

        return $this->render('DomotiqueReseauBundle:Log:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Log entity.
     *
     * @param Log $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Log $entity)
    {
        $form = $this->createForm(new LogType(), $entity, array(
            'action' => $this->generateUrl('admin_sensor_log_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Log entity.
     *
     */
    public function newAction()
    {
        $entity = new Log();
        $form   = $this->createCreateForm($entity);

        return $this->render('DomotiqueReseauBundle:Log:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Log entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiqueReseauBundle:Log')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Log entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DomotiqueReseauBundle:Log:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Log entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiqueReseauBundle:Log')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Log entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DomotiqueReseauBundle:Log:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Log entity.
    *
    * @param Log $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Log $entity)
    {
        $form = $this->createForm(new LogType(), $entity, array(
            'action' => $this->generateUrl('admin_sensor_log_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Log entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiqueReseauBundle:Log')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Log entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_sensor_log_edit', array('id' => $id)));
        }

        return $this->render('DomotiqueReseauBundle:Log:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Log entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DomotiqueReseauBundle:Log')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Log entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_sensor_log'));
    }

    /**
     * Creates a form to delete a Log entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_sensor_log_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
