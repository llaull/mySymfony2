<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151030130403 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO `domotique__sensor_unit` (`id`, `symbole`, `name`, `slug`) VALUES
(2, '°C', 'Température', 'temperature'),
(3, '%', 'Humidité', 'humidite'),
(1, 'V', 'Tension ', 'tension'),
(4, 'hPa', 'Baromètre', 'pression'),
(5, 'm', 'Altimetre', 'altimetre'),
(6, 'lux', 'Luminosité', 'lux'),
(7, 'ping', 'Implusion', 'implusion');");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
