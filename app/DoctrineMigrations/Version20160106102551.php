<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160106102551 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO `carnet2voyage__generalTexte` (`id`, `created`, `modified`, `title`, `slug`, `contenu`, `use_in_menu`, `ordre`) VALUES
(1, '2016-01-06 10:34:51', '2016-01-06 10:34:51', 'test', 'test', '<p>page de test Travis</p>', 1, NULL);");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {

    }
}
