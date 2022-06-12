<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateMembersTable extends AbstractMigration
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
    public function up(): void
    {
      $sql = 'CREATE TABLE `members`(
              `id` int(5) PRIMARY KEY AUTO_INCREMENT,
              `con_id` int(5) NOT NULL,
              `member_id` int(5) NOT NULL,
              CONSTRAINT member_conversation_FK
              FOREIGN KEY (con_id) REFERENCES conversations (con_id))';
      $this->execute($sql);
    }
}
