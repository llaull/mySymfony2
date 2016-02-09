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
        SELECT  DATE_FORMAT(logs.created, '%Y-%m-%d') AS jour,
               CONCAT(HOUR(logs.created),':00') AS heure,
               ROUND(AVG(`sonsor_value`),2) AS moyenne,
               ROUND(MAX(`sonsor_value`),2) AS maxi,
               ROUND(MIN(`sonsor_value`),2) AS mini,
                CONCAT(DATE_FORMAT(logs.created, '%Y-%m-%d'),' ',CONCAT(HOUR(logs.created),':00')) AS l,
               `module_id`,
               `sonsor_id`,
               unit.nom AS sonsor_unitee,
               unit.symbole AS sonde_symbole,
               type.nom AS sondy_type,
               logs.id AS ID,
               info.emplacement_id
        FROM domotique__sensor_log AS logs
        INNER JOIN domotique__sonde_unit AS unit ON unit.id = logs.sonsor_unit
        INNER JOIN domotique__sonde_type AS type ON type.id = logs.sensor_type
        INNER JOIN domotique__module AS info on info.id = logs.module_id
        WHERE logs.created > DATE_SUB(NOW(), INTERVAL 24 HOUR)
        AND type.id in (2,3,4)
        AND unit.id = 2
        GROUP BY YEAR(logs.created),
                 MONTH(logs.created),
                 DAY(logs.created),
                 HOUR(logs.created),
                 -- MINUTE(created),
                 `module_id`,
                 `sonsor_id`,
                 `sensor_type`,
                 `sonsor_unit`
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