<?php

use Phinx\Migration\AbstractMigration;

class CreateCategoriesTable extends AbstractMigration
{

    public function up()
    {
        $categories = $this->table('categories');
        $categories->addColumn('name', 'string')
                ->addColumn('description', 'string')
                ->save();
    }

    public function down()
    {
        $this->dropTable('categories');
    }
}
