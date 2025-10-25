<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Users extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('name', 'text', ['null' => true])
              ->addColumn('email', 'text', ['null' => true])
              ->addColumn('password', 'text', ['null' => true])
              ->addColumn('type', 'enum', ['values' => ['superadmin', 'admin', 'tk', 'sd', 'smp', 'sma'], 'default' => 'admin'])
              ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP','null' => false])
              ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP','null' => false])
              ->addColumn('deleted_at', 'timestamp', ['null' => true, 'default' => null])
              ->create();
    }
}
