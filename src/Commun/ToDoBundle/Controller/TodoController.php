<?php

namespace Commun\ToDoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Commun\ToDoBundle\Entity\Todo;
use Commun\ToDoBundle\Form\TodoType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Todo controller.
 *
 */
class TodoController extends Controller
{

    /**
     * Lists all todo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $entity = $em->getRepository('CommunToDoBundle:Todo')->findByUser($user->getId());

        return $this->container->get('templating')->renderResponse('CommunToDoBundle:Todo:UserTasksPanel.html.twig', array(
            'entity' => $entity
        ));
    }


    /**
     * Displays a form to create a new Todo entity.
     *
     */
    public function newAction(Request $request)
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $data = $request->request->get('data');
        $now = new \DateTime();

        $stmt = $this->getDoctrine()->getEntityManager()
            ->getConnection()
            ->prepare('INSERT INTO commun__todo (id, user_id, added, modified, value, status) VALUES
          (NULL, :user_id, :added, NULL, :value, 1);');
        $stmt->bindValue('user_id', $user->getId());
        $stmt->bindValue('added', $now->format('Y-m-d H:i:s'));
        $stmt->bindValue('value', $data);
        $stmt->execute();

        $lastId = $this->getDoctrine()->getEntityManager()->getConnection()->lastInsertId();

//        return (' {string: "ok", id: "1"} ');
        return new Response('{string: "ok", id: "' . $lastId . '"}');


    }


    /**
     * Displays a form to edit an existing Todo entity.
     *
     */
    public function editAction(Request $request)
    {
        $data = $request->request->get('data');
        $params = json_decode($data, true);

        try {
            $stmt = $this->getDoctrine()->getEntityManager()
                ->getConnection()
                ->prepare("UPDATE commun__todo SET status = :statusId WHERE id = :dataId;");
            $stmt->bindValue("dataId", $params["0"]["todo"], \PDO::PARAM_INT);
            $stmt->bindValue("statusId", $params["1"]["done"], \PDO::PARAM_INT);

            $stmt->execute();

            return new JsonResponse(array('string' => 'success', 'id' => '00'));

        } catch (\Doctrine\ORM\ORMException $e) {
            return new JsonResponse(array('string' => $e->getMessage()));
            echo "ERROR:" . $e->getMessage();
        }
    }


    /**
     * Deletes a Todo entity.
     *
     */
    public function deleteAction(Request $request)
    {

        $data = $request->request->get('data');
        try {
            $stmt = $this->getDoctrine()->getEntityManager()
                ->getConnection()
                ->prepare("DELETE FROM commun__todo WHERE `id` = :dataId;");
            $stmt->bindValue("dataId", $data, \PDO::PARAM_INT);

            $stmt->execute();

            return new JsonResponse(array('string' => 'success'));

        } catch (\Doctrine\ORM\ORMException $e) {
            return new JsonResponse(array('string' => $e->getMessage()));
            echo "ERROR:" . $e->getMessage();
        }

    }

}
