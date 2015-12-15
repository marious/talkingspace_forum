<?php

use Phinx\Migration\AbstractMigration;

class CreateRepliesTable extends AbstractMigration
{
    public function up()
    {
        $replies = $this->table('replies');
        $replies->addColumn('topic_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('body', 'string')
            ->addColumn('create_date', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->save();
    }

    public function down()
    {
        $this->dropTable('replies');
    }
}
