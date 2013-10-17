<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131017182255 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE MenuItem (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, ordinate INT NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_93953FBECCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Menu (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, alias VARCHAR(255) NOT NULL, template VARCHAR(255) DEFAULT NULL, UNIQUE INDEX alias_idx (alias), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE MenuItem ADD CONSTRAINT FK_93953FBECCD7E912 FOREIGN KEY (menu_id) REFERENCES Menu (id)");
    
        $this->addSql("INSERT INTO `Menu` (`id`, `title`, `alias`, `template`) VALUES (1, 'Main', 'main', NULL)");
        $this->addSql("INSERT INTO `MenuItem` (`id`, `menu_id`, `title`, `url`, `ordinate`, `active`) VALUES (NULL, 1, 'Home', '/', '0', '1'), (NULL, 1, 'Blog', '/blog', '1', '1'), (NULL, 1, 'About me', '/me', '2', '1')");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE MenuItem DROP FOREIGN KEY FK_93953FBECCD7E912");
        $this->addSql("DROP TABLE MenuItem");
        $this->addSql("DROP TABLE Menu");
    }
}
