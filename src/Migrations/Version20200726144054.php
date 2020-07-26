<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200726144054 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE first_needs (id INT AUTO_INCREMENT NOT NULL, simulation_id INT NOT NULL, starting_cash INT NOT NULL, starting_investment INT NOT NULL, depreciation INT NOT NULL, starting_stock INT NOT NULL, others_needs INT NOT NULL, UNIQUE INDEX UNIQ_4B1AB8E4FEC09103 (simulation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE first_needs ADD CONSTRAINT FK_4B1AB8E4FEC09103 FOREIGN KEY (simulation_id) REFERENCES simulation (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE first_needs');
    }
}
