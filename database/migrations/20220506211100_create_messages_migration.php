<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateMessagesMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
      $sql = 'CREATE TABLE `messages`(
              `id` int(5) PRIMARY KEY AUTO_INCREMENT,
              `con_id` int(5) NOT NULL,
              `sender` int(5) NOT NULL,
              `time` varchar(30) NOT NULL,
              `text` varchar(255),
              CONSTRAINT messages_conversation_FK
              FOREIGN KEY (con_id) REFERENCES conversations (con_id))';
      $this->execute($sql);
    }
}
