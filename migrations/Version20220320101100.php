<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220320101100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE measurement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE measurement_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sensor_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sensor_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE variety_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE measurement (id INT NOT NULL, measurement_type INT DEFAULT NULL, variety_type INT DEFAULT NULL, year INT NOT NULL, colour VARCHAR(50) NOT NULL, temperature INT NOT NULL, graduation INT NOT NULL, ph INT NOT NULL, observations VARCHAR(255) DEFAULT NULL, vine VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2CE0D811FF48B378 ON measurement (measurement_type)');
        $this->addSql('CREATE INDEX IDX_2CE0D811985C1F18 ON measurement (variety_type)');
        $this->addSql('CREATE TABLE measurement_type (id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE sensor (id INT NOT NULL, sensor_type INT DEFAULT NULL, value VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BC8617B0A13AC686 ON sensor (sensor_type)');
        $this->addSql('CREATE TABLE sensor_type (id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE variety_type (id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE measurement ADD CONSTRAINT FK_2CE0D811FF48B378 FOREIGN KEY (measurement_type) REFERENCES measurement_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE measurement ADD CONSTRAINT FK_2CE0D811985C1F18 FOREIGN KEY (variety_type) REFERENCES variety_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sensor ADD CONSTRAINT FK_BC8617B0A13AC686 FOREIGN KEY (sensor_type) REFERENCES sensor_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE measurement DROP CONSTRAINT FK_2CE0D811FF48B378');
        $this->addSql('ALTER TABLE sensor DROP CONSTRAINT FK_BC8617B0A13AC686');
        $this->addSql('ALTER TABLE measurement DROP CONSTRAINT FK_2CE0D811985C1F18');
        $this->addSql('DROP SEQUENCE measurement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE measurement_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sensor_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sensor_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE variety_type_id_seq CASCADE');
        $this->addSql('DROP TABLE measurement');
        $this->addSql('DROP TABLE measurement_type');
        $this->addSql('DROP TABLE sensor');
        $this->addSql('DROP TABLE sensor_type');
        $this->addSql('DROP TABLE variety_type');
    }
}
