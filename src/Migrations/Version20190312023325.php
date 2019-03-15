<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190312023325 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE tag (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, last_name VARCHAR(100) NOT NULL, first_name VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TABLE media (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, creator_id INTEGER NOT NULL, date_created DATETIME NOT NULL, status INTEGER NOT NULL, discriminator VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C61220EA6 ON media (creator_id)');
        $this->addSql('CREATE TABLE media_tag (media_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY(media_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_48D8C57EEA9FDD75 ON media_tag (media_id)');
        $this->addSql('CREATE INDEX IDX_48D8C57EBAD26311 ON media_tag (tag_id)');
        $this->addSql('CREATE TABLE quote (id INTEGER NOT NULL, text CLOB NOT NULL, attribution VARCHAR(255) DEFAULT NULL, sub_attribution VARCHAR(255) DEFAULT NULL, date_recorded DATE DEFAULT NULL, public_document_link VARCHAR(255) DEFAULT NULL, source_document_link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE location (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE slide (id INTEGER NOT NULL, image_id INTEGER NOT NULL, quote_id INTEGER NOT NULL, probability INTEGER NOT NULL, decay_percent INTEGER NOT NULL, decay_start DATE DEFAULT NULL, decay_end DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_72EFEE623DA5256D ON slide (image_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_72EFEE62DB805178 ON slide (quote_id)');
        $this->addSql('CREATE TABLE article (id INTEGER NOT NULL, image_id INTEGER DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, text CLOB DEFAULT NULL, author VARCHAR(255) DEFAULT NULL, date_recorded DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_23A0E663DA5256D ON article (image_id)');
        $this->addSql('CREATE TABLE image (id INTEGER NOT NULL, filename VARCHAR(255) NOT NULL, title VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL, date_taken DATE DEFAULT NULL, photographer VARCHAR(255) DEFAULT NULL, organization VARCHAR(255) DEFAULT NULL, crop CLOB DEFAULT NULL --(DC2Type:json)
        , PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE content_category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL, media_filename VARCHAR(255) NOT NULL, probability INTEGER NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE media_tag');
        $this->addSql('DROP TABLE quote');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE slide');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE content_category');
    }
}
