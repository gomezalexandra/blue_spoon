<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200726145146 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE incomes (id INT AUTO_INCREMENT NOT NULL, simulation_id INT NOT NULL, bank_loan INT NOT NULL, personnal_contribution INT NOT NULL, contribution_in_kind INT NOT NULL, starting_grant INT NOT NULL, others_incomes INT NOT NULL, UNIQUE INDEX UNIQ_9DE2B5BDFEC09103 (simulation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE incomes ADD CONSTRAINT FK_9DE2B5BDFEC09103 FOREIGN KEY (simulation_id) REFERENCES simulation (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE incomes');
    }
}
