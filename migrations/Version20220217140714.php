<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220217140714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638719FB48E');
        $this->addSql('DROP INDEX UNIQ_4C62E638719FB48E ON contact');
        $this->addSql('ALTER TABLE contact ADD product_id INT DEFAULT NULL, DROP contacts_id');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6384584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_4C62E6384584665A ON contact (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6384584665A');
        $this->addSql('DROP INDEX IDX_4C62E6384584665A ON contact');
        $this->addSql('ALTER TABLE contact ADD contacts_id INT NOT NULL, DROP product_id');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638719FB48E FOREIGN KEY (contacts_id) REFERENCES contact (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C62E638719FB48E ON contact (contacts_id)');
    }
}
