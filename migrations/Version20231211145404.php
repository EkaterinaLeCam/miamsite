<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231211145404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(70) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT DEFAULT NULL, date_de_publication DATETIME NOT NULL, texte_commentaire LONGTEXT NOT NULL, INDEX IDX_67F068BCC6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, id_image_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, INDEX IDX_6BAF78706D7EC9F8 (id_image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_plat (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT DEFAULT NULL, id_recette_id INT DEFAULT NULL, note INT NOT NULL, INDEX IDX_8042B35FC6EE5C49 (id_utilisateur_id), INDEX IDX_8042B35F2CBBAF3E (id_recette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette (id INT AUTO_INCREMENT NOT NULL, photo_recette_id INT DEFAULT NULL, id_recette_ingredient_id INT DEFAULT NULL, id_sous_categorie_id INT DEFAULT NULL, id_commentaire_id INT NOT NULL, nom VARCHAR(255) NOT NULL, preparation LONGTEXT NOT NULL, temp_de_cuisson VARCHAR(20) NOT NULL, calorie INT NOT NULL, INDEX IDX_49BB6390C555C1E1 (photo_recette_id), INDEX IDX_49BB63901359883C (id_recette_ingredient_id), INDEX IDX_49BB6390F252D75F (id_sous_categorie_id), INDEX IDX_49BB639087FA6C96 (id_commentaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette_ingredient (id INT AUTO_INCREMENT NOT NULL, nom_ingredient_id INT DEFAULT NULL, quantite INT NOT NULL, mesure VARCHAR(50) NOT NULL, INDEX IDX_17C041A91F615A12 (nom_ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categorie (id INT AUTO_INCREMENT NOT NULL, id_categorie_id INT NOT NULL, nom VARCHAR(70) NOT NULL, INDEX IDX_52743D7B9F34925F (id_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE table_de_reponses (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT DEFAULT NULL, id_commentaire_id INT DEFAULT NULL, reponse LONGTEXT NOT NULL, INDEX IDX_598217D7C6EE5C49 (id_utilisateur_id), INDEX IDX_598217D787FA6C96 (id_commentaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(70) NOT NULL, prenom VARCHAR(70) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF78706D7EC9F8 FOREIGN KEY (id_image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE note_plat ADD CONSTRAINT FK_8042B35FC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE note_plat ADD CONSTRAINT FK_8042B35F2CBBAF3E FOREIGN KEY (id_recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390C555C1E1 FOREIGN KEY (photo_recette_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB63901359883C FOREIGN KEY (id_recette_ingredient_id) REFERENCES recette_ingredient (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390F252D75F FOREIGN KEY (id_sous_categorie_id) REFERENCES sous_categorie (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639087FA6C96 FOREIGN KEY (id_commentaire_id) REFERENCES commentaire (id)');
        $this->addSql('ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A91F615A12 FOREIGN KEY (nom_ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7B9F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE table_de_reponses ADD CONSTRAINT FK_598217D7C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE table_de_reponses ADD CONSTRAINT FK_598217D787FA6C96 FOREIGN KEY (id_commentaire_id) REFERENCES commentaire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCC6EE5C49');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF78706D7EC9F8');
        $this->addSql('ALTER TABLE note_plat DROP FOREIGN KEY FK_8042B35FC6EE5C49');
        $this->addSql('ALTER TABLE note_plat DROP FOREIGN KEY FK_8042B35F2CBBAF3E');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390C555C1E1');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB63901359883C');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390F252D75F');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639087FA6C96');
        $this->addSql('ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A91F615A12');
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7B9F34925F');
        $this->addSql('ALTER TABLE table_de_reponses DROP FOREIGN KEY FK_598217D7C6EE5C49');
        $this->addSql('ALTER TABLE table_de_reponses DROP FOREIGN KEY FK_598217D787FA6C96');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE note_plat');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP TABLE recette_ingredient');
        $this->addSql('DROP TABLE sous_categorie');
        $this->addSql('DROP TABLE table_de_reponses');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
