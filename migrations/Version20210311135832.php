<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311135832 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE form_aide_category (form_aide_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_D37A367E57706C18 (form_aide_id), INDEX IDX_D37A367E12469DE2 (category_id), PRIMARY KEY(form_aide_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE form_aide_category ADD CONSTRAINT FK_D37A367E57706C18 FOREIGN KEY (form_aide_id) REFERENCES form_aide (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE form_aide_category ADD CONSTRAINT FK_D37A367E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE form_aide_category DROP FOREIGN KEY FK_D37A367E12469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE form_aide_category');
    }
}
