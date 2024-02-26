<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240125102238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonnement DROP INDEX UNIQ_351268BBBCF5E72D, ADD INDEX IDX_351268BBBCF5E72D (categorie_id)');
        $this->addSql('ALTER TABLE abonnement DROP INDEX UNIQ_351268BB19EB6921, ADD INDEX IDX_351268BB19EB6921 (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonnement DROP INDEX IDX_351268BBBCF5E72D, ADD UNIQUE INDEX UNIQ_351268BBBCF5E72D (categorie_id)');
        $this->addSql('ALTER TABLE abonnement DROP INDEX IDX_351268BB19EB6921, ADD UNIQUE INDEX UNIQ_351268BB19EB6921 (client_id)');
    }
}
