<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220320103928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO public.measurement_type (id, name) VALUES (1, 'tipo medicion 1')");
        $this->addSql("INSERT INTO public.measurement_type (id, name) VALUES (2, 'tipo medicion 2')");
        $this->addSql("INSERT INTO public.measurement_type (id, name) VALUES (3, 'tipo medicion 3')");

        $this->addSql("INSERT INTO public.variety_type (id, name) VALUES (1, 'variedad 1')");
        $this->addSql("INSERT INTO public.variety_type (id, name) VALUES (2, 'variedad 2')");
        $this->addSql("INSERT INTO public.variety_type (id, name) VALUES (3, 'variedad 3')");

        $this->addSql("INSERT INTO public.sensor_type (id, name) VALUES (1, 'tipo sensor 1')");
        $this->addSql("INSERT INTO public.sensor_type (id, name) VALUES (2, 'tipo_sensor 2')");
        $this->addSql("INSERT INTO public.sensor_type (id, name) VALUES (3, 'tipo_sensor 3')");

        $this->addSql("INSERT INTO public.sensor (id, value, sensor_type) VALUES (1, 'sensor 1', 1)");
        $this->addSql("INSERT INTO public.sensor (id, value, sensor_type) VALUES (2, 'sensor 2', 2)");
        $this->addSql("INSERT INTO public.sensor (id, value, sensor_type) VALUES (3, 'sensor 3', 2)");
        $this->addSql("INSERT INTO public.sensor (id, value, sensor_type) VALUES (4, 'sensor 4', 3)");
        $this->addSql("INSERT INTO public.sensor (id, value, sensor_type) VALUES (5, 'sensor 5', 3)");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('delete from public.sensor;');
        $this->addSql('delete from public.measurement_type;');
        $this->addSql('delete from public.sensor_type;');
        $this->addSql('delete from public.variety_type;');
    }
}
