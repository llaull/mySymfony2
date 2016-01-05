<?php
/**
 * Created by PhpStorm.
 * User: moi
 * Date: 05/01/2016
 * Time: 11:08
 */

namespace CarnetsBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BlogRepository extends EntityRepository
{

    public function findArticleWithInfo($em)
    {
        $rq = "SELECT A.title, A.slug, A.actived, A.image, A.publied, U.username, (SELECT count(*) FROM carnet2voyage__blogcomment WHERE arcticle_id = A.id) AS commentNb, Cat.title FROM carnet2voyage__blogarticle AS A JOIN carnet2voyage__blogcategory AS Cat ON Cat.id = A.category_id JOIN commun__user AS U ON U.id = A.autor_id";

        $connection = $em->getConnection();
        $statement = $connection->prepare($rq);
        $statement->execute();
        $results = $statement->fetchAll();

        return $results;
    }

}