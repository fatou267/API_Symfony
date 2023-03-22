<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230321232606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE buildings (id INT AUTO_INCREMENT NOT NULL, id_organisation_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, zipcode VARCHAR(5) NOT NULL, INDEX IDX_9A51B6A77735D60D (id_organisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisations (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pieces (id INT AUTO_INCREMENT NOT NULL, id_buildings_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, presonnes_presentes INT DEFAULT NULL, INDEX IDX_B92D747237449361 (id_buildings_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE buildings ADD CONSTRAINT FK_9A51B6A77735D60D FOREIGN KEY (id_organisation_id) REFERENCES organisations (id)');
        $this->addSql('ALTER TABLE pieces ADD CONSTRAINT FK_B92D747237449361 FOREIGN KEY (id_buildings_id) REFERENCES buildings (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE buildings DROP FOREIGN KEY FK_9A51B6A77735D60D');
        $this->addSql('ALTER TABLE pieces DROP FOREIGN KEY FK_B92D747237449361');
        $this->addSql('DROP TABLE buildings');
        $this->addSql('DROP TABLE organisations');
        $this->addSql('DROP TABLE pieces');
    }
}
