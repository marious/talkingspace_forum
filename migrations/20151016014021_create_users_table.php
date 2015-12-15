<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{

    public function up()
    {
        $users = $this->table('users');
        $users->addColumn('name', 'string', ['limit' => 50])
                ->addColumn('email', 'string')
                ->addColumn('avatar', 'string', ['default' => 'no-image.png'])
                ->addColumn('username', 'string', ['limit' => 20])
                ->addColumn('password', 'string')
                ->addColumn('about', 'string', ['null' => true])
                ->addColumn('last_activity', 'datetime', ['null' => true])
                ->addColumn('join_date', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
                ->save();
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
