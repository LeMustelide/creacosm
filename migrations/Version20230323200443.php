<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230323200443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE history_answer (history_id INT NOT NULL, answer_id INT NOT NULL, PRIMARY KEY(history_id, answer_id))');
        $this->addSql('CREATE INDEX IDX_95206D61E058452 ON history_answer (history_id)');
        $this->addSql('CREATE INDEX IDX_95206D6AA334807 ON history_answer (answer_id)');
        $this->addSql('ALTER TABLE history_answer ADD CONSTRAINT FK_95206D61E058452 FOREIGN KEY (history_id) REFERENCES history (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE history_answer ADD CONSTRAINT FK_95206D6AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE history ADD poll_id INT NOT NULL');
        $this->addSql('ALTER TABLE history ADD text_answer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE history ADD number_answer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B3C947C0F FOREIGN KEY (poll_id) REFERENCES poll (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B593C7BC3 FOREIGN KEY (text_answer_id) REFERENCES text_answer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B87B1B57F FOREIGN KEY (number_answer_id) REFERENCES number_answer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_27BA704B3C947C0F ON history (poll_id)');
        $this->addSql('CREATE INDEX IDX_27BA704B593C7BC3 ON history (text_answer_id)');
        $this->addSql('CREATE INDEX IDX_27BA704B87B1B57F ON history (number_answer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE history_answer DROP CONSTRAINT FK_95206D61E058452');
        $this->addSql('ALTER TABLE history_answer DROP CONSTRAINT FK_95206D6AA334807');
        $this->addSql('DROP TABLE history_answer');
        $this->addSql('ALTER TABLE history DROP CONSTRAINT FK_27BA704B3C947C0F');
        $this->addSql('ALTER TABLE history DROP CONSTRAINT FK_27BA704B593C7BC3');
        $this->addSql('ALTER TABLE history DROP CONSTRAINT FK_27BA704B87B1B57F');
        $this->addSql('DROP INDEX IDX_27BA704B3C947C0F');
        $this->addSql('DROP INDEX IDX_27BA704B593C7BC3');
        $this->addSql('DROP INDEX IDX_27BA704B87B1B57F');
        $this->addSql('ALTER TABLE history DROP poll_id');
        $this->addSql('ALTER TABLE history DROP text_answer_id');
        $this->addSql('ALTER TABLE history DROP number_answer_id');
    }
}
