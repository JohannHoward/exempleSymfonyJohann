<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240119082731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonnement ADD categorie_id INT DEFAULT NULL, ADD chaine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BBBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB3129D93D FOREIGN KEY (chaine_id) REFERENCES chaine (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_351268BBBCF5E72D ON abonnement (categorie_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_351268BB3129D93D ON abonnement (chaine_id)');
        $this->addSql('ALTER TABLE categorie CHANGE nombre_chaine nombre_chaine INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BBBCF5E72D');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB3129D93D');
        $this->addSql('DROP INDEX UNIQ_351268BBBCF5E72D ON abonnement');
        $this->addSql('DROP INDEX UNIQ_351268BB3129D93D ON abonnement');
        $this->addSql('ALTER TABLE abonnement DROP categorie_id, DROP chaine_id');
        $this->addSql('ALTER TABLE categorie CHANGE nombre_chaine nombre_chaine TINYINT(1) NOT NULL');
    }
}
