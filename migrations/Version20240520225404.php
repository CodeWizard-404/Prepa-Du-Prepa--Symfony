<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240520225404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration to create tables and insert massive data';
    }

    public function up(Schema $schema): void
    {
        // Create tables (as you originally defined)
        $this->addSql('CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, course_id INT DEFAULT NULL, content LONGTEXT DEFAULT NULL, type VARCHAR(20) NOT NULL, title VARCHAR(20) NOT NULL, description LONGTEXT DEFAULT NULL, subject VARCHAR(60) DEFAULT NULL, document_path VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_FEC530A9591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, title VARCHAR(60) NOT NULL, description LONGTEXT DEFAULT NULL, level VARCHAR(20) NOT NULL, subjects JSON NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_169E6FB979F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', role VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, telephone VARCHAR(8) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Add foreign keys
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB979F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        
        $this->addSql("INSERT INTO user (email, roles, role, password, username, telephone) VALUES
        ('admin@example.com', '[\"ROLE_ADMIN\"]', 'admin', 'admin', 'admin', '123456');");

        // Insert massive data (100,000 users, 1,000 courses, 10,000 content, 100,000 messages)
        for ($i = 1; $i <= 100; $i++) {
            $this->addSql("INSERT INTO user (email, roles, role, password, username, telephone) VALUES
                ('user{$i}@example.com', '[\"ROLE_USER\"]', 'student', 'password_hash_{$i}', 'user{$i}', '12345678{$i}');");
        }

        for ($i = 1; $i <= 100; $i++) {
            $userId = rand(1, 100);  // Random user for each course
            $level = ['Beginner', 'Intermediate', 'Advanced'][rand(0, 2)];
            $this->addSql("INSERT INTO course (id_user_id, title, description, level, subjects) VALUES
                ({$userId}, 'Course {$i} Title', 'Description of course {$i}', '{$level}', '[\"Programming\", \"Web Development\"]');");
        }

        for ($i = 1; $i <= 100; $i++) {
            $courseId = rand(1, 100);  // Random course for each content
            $contentType = ['video', 'article', 'quiz'][rand(0, 2)];
            $this->addSql("INSERT INTO content (course_id, content, type, title, description, subject, document_path, updated_at) VALUES
                ({$courseId}, 'Content for course {$courseId} - {$contentType}', '{$contentType}', 'Content Title {$i}', 'Description for content {$i}', 'Programming', '/docs/content_{$i}.pdf', NOW());");
        }

        for ($i = 1; $i <= 100; $i++) {
            $queueName = 'queue' . rand(1, 10);  // Random queue name
            $this->addSql("INSERT INTO messenger_messages (body, headers, queue_name, created_at, available_at, delivered_at) VALUES
                ('Message body for message {$i}', 'Message headers for message {$i}', '{$queueName}', NOW(), NOW(), NULL);");
        }
    }

    public function down(Schema $schema): void
    {
        // Drop tables and constraints
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9591CC992');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB979F37AE5');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
