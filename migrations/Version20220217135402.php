<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220217135402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638E7A1254A');
        $this->addSql('DROP INDEX UNIQ_4C62E638E7A1254A ON contact');
        $this->addSql('ALTER TABLE contact CHANGE contact_id contacts_id INT NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638719FB48E FOREIGN KEY (contacts_id) REFERENCES contact (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C62E638719FB48E ON contact (contacts_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638719FB48E');
        $this->addSql('DROP INDEX UNIQ_4C62E638719FB48E ON contact');
        $this->addSql('ALTER TABLE contact CHANGE contacts_id contact_id INT NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C62E638E7A1254A ON contact (contact_id)');
    }
}
