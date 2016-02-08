<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151030130233 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO `domotique__module_emplacement` (`id`, `name`) VALUES
(1, 'salon'),
(2, 'test'),
(3, 'bureau'),
(4, 'Buanderie'),
(5, 'Chambre llm');");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {

    }
}
