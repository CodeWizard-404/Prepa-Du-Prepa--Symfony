<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240505172407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur ADD id_utilisateur_id INT NOT NULL, DROP id');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE utilisateur ADD PRIMARY KEY (id_utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3C6EE5C49');
        $this->addSql('ALTER TABLE utilisateur ADD id INT AUTO_INCREMENT NOT NULL, DROP id_utilisateur_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
