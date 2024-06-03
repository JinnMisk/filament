<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240603080924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bulb ADD place_id_id INT NOT NULL, ADD mood_id_id INT DEFAULT NULL, DROP reference, DROP model, CHANGE hours_max model_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bulb ADD CONSTRAINT FK_88A56EF04107BEA0 FOREIGN KEY (model_id_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE bulb ADD CONSTRAINT FK_88A56EF0D6328574 FOREIGN KEY (place_id_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE bulb ADD CONSTRAINT FK_88A56EF076C5A04A FOREIGN KEY (mood_id_id) REFERENCES mood (id)');
        $this->addSql('CREATE INDEX IDX_88A56EF04107BEA0 ON bulb (model_id_id)');
        $this->addSql('CREATE INDEX IDX_88A56EF0D6328574 ON bulb (place_id_id)');
        $this->addSql('CREATE INDEX IDX_88A56EF076C5A04A ON bulb (mood_id_id)');
        $this->addSql('ALTER TABLE model ADD name VARCHAR(255) NOT NULL, ADD default_color VARCHAR(255) DEFAULT NULL, ADD default_luminosity DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE mood ADD user_id_id INT NOT NULL, ADD label VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE mood ADD CONSTRAINT FK_339AEF69D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_339AEF69D86650F ON mood (user_id_id)');
        $this->addSql('ALTER TABLE place ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_741D53CD9D86650F ON place (user_id_id)');
        $this->addSql('ALTER TABLE schedule ADD user_id_id INT NOT NULL, ADD mood_id_id INT DEFAULT NULL, ADD label VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB76C5A04A FOREIGN KEY (mood_id_id) REFERENCES mood (id)');
        $this->addSql('CREATE INDEX IDX_5A3811FB9D86650F ON schedule (user_id_id)');
        $this->addSql('CREATE INDEX IDX_5A3811FB76C5A04A ON schedule (mood_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bulb DROP FOREIGN KEY FK_88A56EF04107BEA0');
        $this->addSql('ALTER TABLE bulb DROP FOREIGN KEY FK_88A56EF0D6328574');
        $this->addSql('ALTER TABLE bulb DROP FOREIGN KEY FK_88A56EF076C5A04A');
        $this->addSql('DROP INDEX IDX_88A56EF04107BEA0 ON bulb');
        $this->addSql('DROP INDEX IDX_88A56EF0D6328574 ON bulb');
        $this->addSql('DROP INDEX IDX_88A56EF076C5A04A ON bulb');
        $this->addSql('ALTER TABLE bulb ADD reference VARCHAR(255) NOT NULL, ADD model VARCHAR(255) NOT NULL, ADD hours_max INT DEFAULT NULL, DROP model_id_id, DROP place_id_id, DROP mood_id_id');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB9D86650F');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB76C5A04A');
        $this->addSql('DROP INDEX IDX_5A3811FB9D86650F ON schedule');
        $this->addSql('DROP INDEX IDX_5A3811FB76C5A04A ON schedule');
        $this->addSql('ALTER TABLE schedule DROP user_id_id, DROP mood_id_id, DROP label');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD9D86650F');
        $this->addSql('DROP INDEX IDX_741D53CD9D86650F ON place');
        $this->addSql('ALTER TABLE place DROP user_id_id');
        $this->addSql('ALTER TABLE mood DROP FOREIGN KEY FK_339AEF69D86650F');
        $this->addSql('DROP INDEX IDX_339AEF69D86650F ON mood');
        $this->addSql('ALTER TABLE mood DROP user_id_id, DROP label');
        $this->addSql('ALTER TABLE model DROP name, DROP default_color, DROP default_luminosity');
    }
}
