<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateConversationsTable extends AbstractMigration
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
      $sql = 'CREATE TABLE `conversations`(
              `con_id` int(5) PRIMARY KEY AUTO_INCREMENT,
              `name` varchar(50) DEFAULT NULL,
              `created` varchar(20) NOT NULL,
              `folder` varchar(255) DEFAULT NULL)';
      $this->execute($sql);
    }
}
