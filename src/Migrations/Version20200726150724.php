<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200726150724 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE costs (id INT AUTO_INCREMENT NOT NULL, simulation_id INT NOT NULL, salaries INT NOT NULL, salaries_increase INT NOT NULL, rent INT NOT NULL, insurance INT NOT NULL, others_fixed_costs INT NOT NULL, variable_costs INT NOT NULL, taxes INT NOT NULL, corporation_tax INT NOT NULL, UNIQUE INDEX UNIQ_AF1D57A8FEC09103 (simulation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE costs ADD CONSTRAINT FK_AF1D57A8FEC09103 FOREIGN KEY (simulation_id) REFERENCES simulation (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE costs');
    }
}
