<?php


use Phinx\Migration\AbstractMigration;

class CreateShowsTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $shows = $this->table('shows');
        $shows->addColumn('name', 'string')
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
        $this->dropTable('shows');
    }

}