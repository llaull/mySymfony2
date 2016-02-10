<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151030130235 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO `domotique__sonde_type` (`id`, `name`) VALUES
(2, 'DHT11'),
(5, 'PIR_sonde'),
(1, 'systeme'),
(7, 'matrixR8'),
(3, 'DHT22'),
(4, 'BMP'),
(6, 'Luxmetre'),
(8, 'RubanRGB');");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
