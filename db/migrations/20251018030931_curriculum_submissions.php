<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CurriculumSubmissions extends AbstractMigration
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
        $table = $this->table('curriculum_submissions');
        $table->addColumn('institution_id', 'integer', ['signed' => false]) // foreign key
              ->addColumn('file', 'text', ['null' => true])
              ->addColumn('status', 'enum', ['values' => ['in_review', 'not_approved', 'approved'], 'default' => 'in_review'])
              ->addColumn('remark', 'text', ['null' => true])
              ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP','null' => false])
              ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP','null' => false])
              ->addColumn('deleted_at', 'timestamp', ['default' => null, 'null' => true])
              ->addForeignKey('institution_id', 'institutions', 'id', [
                'delete'=> 'CASCADE', 
                'update'=> 'CASCADE'
              ])
              ->create();
    }
}
