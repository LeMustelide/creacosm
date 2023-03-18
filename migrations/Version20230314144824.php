<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230314144824 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE history_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE number_answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_mcqmultiple_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_mcqsingle_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_number_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_text_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE text_answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE answer (id INT NOT NULL, question_multiple_id INT DEFAULT NULL, question_single_id INT DEFAULT NULL, entitled VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DADD4A254DD893F0 ON answer (question_multiple_id)');
        $this->addSql('CREATE INDEX IDX_DADD4A25EE149DB0 ON answer (question_single_id)');
        $this->addSql('CREATE TABLE history (id INT NOT NULL, uuid UUID NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE number_answer (id INT NOT NULL, question_id INT NOT NULL, value DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4FD949241E27F6BF ON number_answer (question_id)');
        $this->addSql('CREATE TABLE question_mcqmultiple (id INT NOT NULL, entitled VARCHAR(255) NOT NULL, min_number_answer INT NOT NULL, max_number_answer INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE question_mcqmultiple_poll (question_mcqmultiple_id INT NOT NULL, poll_id INT NOT NULL, PRIMARY KEY(question_mcqmultiple_id, poll_id))');
        $this->addSql('CREATE INDEX IDX_BAD622B0CB3195D6 ON question_mcqmultiple_poll (question_mcqmultiple_id)');
        $this->addSql('CREATE INDEX IDX_BAD622B03C947C0F ON question_mcqmultiple_poll (poll_id)');
        $this->addSql('CREATE TABLE question_mcqsingle (id INT NOT NULL, entitled VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE question_mcqsingle_poll (question_mcqsingle_id INT NOT NULL, poll_id INT NOT NULL, PRIMARY KEY(question_mcqsingle_id, poll_id))');
        $this->addSql('CREATE INDEX IDX_14345A08FB783D1 ON question_mcqsingle_poll (question_mcqsingle_id)');
        $this->addSql('CREATE INDEX IDX_14345A03C947C0F ON question_mcqsingle_poll (poll_id)');
        $this->addSql('CREATE TABLE question_number (id INT NOT NULL, entitled VARCHAR(255) NOT NULL, nb_start DOUBLE PRECISION NOT NULL, nb_end DOUBLE PRECISION NOT NULL, step DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE question_number_poll (question_number_id INT NOT NULL, poll_id INT NOT NULL, PRIMARY KEY(question_number_id, poll_id))');
        $this->addSql('CREATE INDEX IDX_257CEE7D39749A8B ON question_number_poll (question_number_id)');
        $this->addSql('CREATE INDEX IDX_257CEE7D3C947C0F ON question_number_poll (poll_id)');
        $this->addSql('CREATE TABLE question_text (id INT NOT NULL, entitled VARCHAR(255) NOT NULL, min_character_limit INT NOT NULL, max_character_limit INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE question_text_poll (question_text_id INT NOT NULL, poll_id INT NOT NULL, PRIMARY KEY(question_text_id, poll_id))');
        $this->addSql('CREATE INDEX IDX_8A17C0EB6751E055 ON question_text_poll (question_text_id)');
        $this->addSql('CREATE INDEX IDX_8A17C0EB3C947C0F ON question_text_poll (poll_id)');
        $this->addSql('CREATE TABLE text_answer (id INT NOT NULL, question_id INT NOT NULL, content VARCHAR(2048) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CF51D3D61E27F6BF ON text_answer (question_id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A254DD893F0 FOREIGN KEY (question_multiple_id) REFERENCES question_mcqmultiple (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25EE149DB0 FOREIGN KEY (question_single_id) REFERENCES question_mcqsingle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE number_answer ADD CONSTRAINT FK_4FD949241E27F6BF FOREIGN KEY (question_id) REFERENCES question_number (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_mcqmultiple_poll ADD CONSTRAINT FK_BAD622B0CB3195D6 FOREIGN KEY (question_mcqmultiple_id) REFERENCES question_mcqmultiple (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_mcqmultiple_poll ADD CONSTRAINT FK_BAD622B03C947C0F FOREIGN KEY (poll_id) REFERENCES poll (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_mcqsingle_poll ADD CONSTRAINT FK_14345A08FB783D1 FOREIGN KEY (question_mcqsingle_id) REFERENCES question_mcqsingle (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_mcqsingle_poll ADD CONSTRAINT FK_14345A03C947C0F FOREIGN KEY (poll_id) REFERENCES poll (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_number_poll ADD CONSTRAINT FK_257CEE7D39749A8B FOREIGN KEY (question_number_id) REFERENCES question_number (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_number_poll ADD CONSTRAINT FK_257CEE7D3C947C0F FOREIGN KEY (poll_id) REFERENCES poll (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_text_poll ADD CONSTRAINT FK_8A17C0EB6751E055 FOREIGN KEY (question_text_id) REFERENCES question_text (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_text_poll ADD CONSTRAINT FK_8A17C0EB3C947C0F FOREIGN KEY (poll_id) REFERENCES poll (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE text_answer ADD CONSTRAINT FK_CF51D3D61E27F6BF FOREIGN KEY (question_id) REFERENCES question_text (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE answer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE history_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE number_answer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_mcqmultiple_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_mcqsingle_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_number_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_text_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE text_answer_id_seq CASCADE');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A254DD893F0');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A25EE149DB0');
        $this->addSql('ALTER TABLE number_answer DROP CONSTRAINT FK_4FD949241E27F6BF');
        $this->addSql('ALTER TABLE question_mcqmultiple_poll DROP CONSTRAINT FK_BAD622B0CB3195D6');
        $this->addSql('ALTER TABLE question_mcqmultiple_poll DROP CONSTRAINT FK_BAD622B03C947C0F');
        $this->addSql('ALTER TABLE question_mcqsingle_poll DROP CONSTRAINT FK_14345A08FB783D1');
        $this->addSql('ALTER TABLE question_mcqsingle_poll DROP CONSTRAINT FK_14345A03C947C0F');
        $this->addSql('ALTER TABLE question_number_poll DROP CONSTRAINT FK_257CEE7D39749A8B');
        $this->addSql('ALTER TABLE question_number_poll DROP CONSTRAINT FK_257CEE7D3C947C0F');
        $this->addSql('ALTER TABLE question_text_poll DROP CONSTRAINT FK_8A17C0EB6751E055');
        $this->addSql('ALTER TABLE question_text_poll DROP CONSTRAINT FK_8A17C0EB3C947C0F');
        $this->addSql('ALTER TABLE text_answer DROP CONSTRAINT FK_CF51D3D61E27F6BF');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE history');
        $this->addSql('DROP TABLE number_answer');
        $this->addSql('DROP TABLE question_mcqmultiple');
        $this->addSql('DROP TABLE question_mcqmultiple_poll');
        $this->addSql('DROP TABLE question_mcqsingle');
        $this->addSql('DROP TABLE question_mcqsingle_poll');
        $this->addSql('DROP TABLE question_number');
        $this->addSql('DROP TABLE question_number_poll');
        $this->addSql('DROP TABLE question_text');
        $this->addSql('DROP TABLE question_text_poll');
        $this->addSql('DROP TABLE text_answer');
    }
}
