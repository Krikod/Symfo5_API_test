<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131142623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX search_idx ON annonce');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce CHANGE titre titre VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE marque marque VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE modele modele VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE contenu contenu LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('CREATE FULLTEXT INDEX search_idx ON annonce (modele)');
        $this->addSql('ALTER TABLE categorie CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
    }
}
