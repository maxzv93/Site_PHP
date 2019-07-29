<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190717103542 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__device AS SELECT id, name, memory_size, price FROM device');
        $this->addSql('DROP TABLE device');
        $this->addSql('CREATE TABLE device (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, brand_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, memory_size INTEGER NOT NULL, price DOUBLE PRECISION DEFAULT NULL, CONSTRAINT FK_92FB68E44F5D008 FOREIGN KEY (brand_id) REFERENCES shop_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO device (id, name, memory_size, price) SELECT id, name, memory_size, price FROM __temp__device');
        $this->addSql('DROP TABLE __temp__device');
        $this->addSql('CREATE INDEX IDX_92FB68E44F5D008 ON device (brand_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_92FB68E44F5D008');
        $this->addSql('CREATE TEMPORARY TABLE __temp__device AS SELECT id, name, memory_size, price FROM device');
        $this->addSql('DROP TABLE device');
        $this->addSql('CREATE TABLE device (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, memory_size INTEGER NOT NULL, price DOUBLE PRECISION DEFAULT NULL)');
        $this->addSql('INSERT INTO device (id, name, memory_size, price) SELECT id, name, memory_size, price FROM __temp__device');
        $this->addSql('DROP TABLE __temp__device');
    }
}
