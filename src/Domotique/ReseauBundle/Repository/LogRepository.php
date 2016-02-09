<?php
namespace Domotique\ReseauBundle\Repository;

use Doctrine\ORM\EntityRepository;

class LogRepository extends EntityRepository
{

    /*
     *
     */
    public function moyenneByModuleBySondes($em)
    {

        $rq = "
        SELECT  DATE_FORMAT(created, '%Y-%m-%d') AS jour,
               CONCAT(HOUR(created),':00') AS heure,
               ROUND(AVG(`sonde_valeur`),2) AS moyenne,
               ROUND(MAX(`sonde_valeur`),2) AS maxi,
               ROUND(MIN(`sonde_valeur`),2) AS mini,
                CONCAT(DATE_FORMAT(created, '%Y-%m-%d'),' ',CONCAT(HOUR(created),':00')) AS l,
               `modules_id`,
               `sonde_id`,
               unit.nom AS sonde_unitee,
               unit.symbole AS sonde_symbole,
               type.nom AS sondy_type,
               logs.id AS ID,
               info.emplacement_id
        FROM domotique__module_logs AS logs
        INNER JOIN domotique__sonde_unit AS unit ON unit.id = logs.sonde_unit
        INNER JOIN domotique__sonde_type AS type ON type.id = logs.sonde_type
        INNER JOIN domotique__module AS info on info.id = logs.modules_id
        WHERE created > DATE_SUB(NOW(), INTERVAL 24 HOUR)
        AND type.id in (2,3,4)
        GROUP BY YEAR(created),
                 MONTH(created),
                 DAY(created),
                 HOUR(created),
                 -- MINUTE(created),
                 `modules_id`,
                 `sonde_id`,
                 `sonde_type`,
                 `sonde_unit`
               --  ,info.emplacement_id
        ORDER BY jour, heure ASC
        ";



        $connection = $em->getConnection();
        $statement = $connection->prepare($rq);
        $statement->execute();
        $results = $statement->fetchAll();

        return $results;
    }

}