<?php


use Phinx\Migration\AbstractMigration;

class CreatePresentersTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $presenters = $this->table('presenters');
        $presenters->addColumn('name', 'string')
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('deleted_at', 'datetime',['null' => true])
            ->save();
    }
    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('presenters');
    }
}
