<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class MoveConNameToMembers extends AbstractMigration
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
      $sql1 = 'ALTER TABLE `members`
              ADD COLUMN `con_name` varchar(50)';
      $sql2 = 'ALTER TABLE `conversations`
              DROP COLUMN `name`';
      $this->execute($sql1);
      $this->execute($sql2);
    }
}
