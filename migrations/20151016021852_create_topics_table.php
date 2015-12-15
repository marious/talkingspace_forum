<?php

use Phinx\Migration\AbstractMigration;

class CreateTopicsTable extends AbstractMigration
{
        public function up()
        {
            $topics = $this->table('topics');
            $topics->addColumn('category_id', 'integer', ['null' => true])
                    ->addColumn('user_id', 'integer', ['null' => true])
                    ->addColumn('title', 'string')
                    ->addColumn('body', 'string')
                    ->addColumn('last_activity', 'datetime', ['null' => true])
                    ->addColumn('create_date', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
                    ->save();
        }

        public function down()
        {

        }
}
