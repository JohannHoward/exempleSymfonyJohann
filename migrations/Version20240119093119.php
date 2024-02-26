<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240119093119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chaine ADD type_chaine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE chaine ADD CONSTRAINT FK_94DA53EC85EF982D FOREIGN KEY (type_chaine_id) REFERENCES type_chaine (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_94DA53EC85EF982D ON chaine (type_chaine_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chaine DROP FOREIGN KEY FK_94DA53EC85EF982D');
        $this->addSql('DROP INDEX UNIQ_94DA53EC85EF982D ON chaine');
        $this->addSql('ALTER TABLE chaine DROP type_chaine_id');
    }
}
