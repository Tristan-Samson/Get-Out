<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200624141452 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, hair_id INT NOT NULL, chest_id INT NOT NULL, legs_id INT NOT NULL, health INT NOT NULL, total_exp INT NOT NULL, UNIQUE INDEX UNIQ_937AB034A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type INT NOT NULL, stat INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement_character (equipement_id INT NOT NULL, character_id INT NOT NULL, INDEX IDX_AF6685EB806F0F5C (equipement_id), INDEX IDX_AF6685EB1136BE75 (character_id), PRIMARY KEY(equipement_id, character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quest (id INT AUTO_INCREMENT NOT NULL, equipement_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, type INT NOT NULL, exp INT NOT NULL, INDEX IDX_4317F817806F0F5C (equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE success (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, reward_points INT NOT NULL, reward_exp INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE success_user (success_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_26E32381A63B36F1 (success_id), INDEX IDX_26E32381A76ED395 (user_id), PRIMARY KEY(success_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE equipement_character ADD CONSTRAINT FK_AF6685EB806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipement_character ADD CONSTRAINT FK_AF6685EB1136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quest ADD CONSTRAINT FK_4317F817806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE success_user ADD CONSTRAINT FK_26E32381A63B36F1 FOREIGN KEY (success_id) REFERENCES success (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE success_user ADD CONSTRAINT FK_26E32381A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement_character DROP FOREIGN KEY FK_AF6685EB1136BE75');
        $this->addSql('ALTER TABLE equipement_character DROP FOREIGN KEY FK_AF6685EB806F0F5C');
        $this->addSql('ALTER TABLE quest DROP FOREIGN KEY FK_4317F817806F0F5C');
        $this->addSql('ALTER TABLE success_user DROP FOREIGN KEY FK_26E32381A63B36F1');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034A76ED395');
        $this->addSql('ALTER TABLE success_user DROP FOREIGN KEY FK_26E32381A76ED395');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE equipement_character');
        $this->addSql('DROP TABLE quest');
        $this->addSql('DROP TABLE success');
        $this->addSql('DROP TABLE success_user');
        $this->addSql('DROP TABLE user');
    }
}
