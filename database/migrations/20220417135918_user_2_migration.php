<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class User2Migration extends AbstractMigration
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
      $tabel = $this->table('users');
      $tabel->addColumn('login', 'string', ['limit' => 50])
            ->addColumn('password', 'string', ['limit' => 200])
            ->addColumn('admin', 'boolean')
            ->create();
    }
}
