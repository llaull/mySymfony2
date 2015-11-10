<?php

namespace Domotique\bundle\ModuleBundle\Repository;

use Doctrine\ORM\EntityRepository;

class LogsRepository extends EntityRepository{

    /**
     * affiche tous les logs en trie
     * @return array
     */
    public function findAll()
    {
        $qb = $this->createQueryBuilder('l');
        $qb->orderBy('l.temps', 'DESC')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    public function reelTime($em)
    {
        $rq = 'SELECT
    l.id,
    l.modules_id,
    l.temps AS date,
    l.sonde_unit,
    l.sonde_type,
    l.sonde_valeur,
    m.module_type,
    m.module_ref,
    u.slug,
    t.nom AS nom_sonde,
    E.nom AS emplacement
FROM
    domotique__module_logs AS l
        INNER JOIN
    (SELECT
        modules_id, sonde_unit, sonde_type, MAX(temps) AS max_temp
    FROM
        domotique__module_logs
    WHERE
        temps > CURDATE()
        AND
        temps > SUBTIME(NOW(),"02:00:00")
         AND
        DATE_SUB(CURTIME(),INTERVAL 1 HOUR) >= temps
    GROUP BY modules_id , sonde_unit , sonde_type) AS b ON b.modules_id = l.modules_id
        AND b.sonde_unit = l.sonde_unit
        AND b.max_temp = l.temps
        LEFT JOIN
    domotique__module_infos AS m ON l.modules_id = m.id
        LEFT JOIN
    domotique__sonde_unit AS u ON l.sonde_unit = u.id
        LEFT JOIN
    domotique__sonde_type AS t ON l.sonde_type = t.id
        LEFT JOIN
    domotique__module_emplacement AS E ON m.emplacement_id = E.id
WHERE
    l.temps > CURDATE()
ORDER BY modules_id , sonde_type , sonde_unit';

        $connection = $em->getConnection();
        $statement = $connection->prepare($rq);
        $statement->execute();
        $results = $statement->fetchAll();

        return $results;
    }
}