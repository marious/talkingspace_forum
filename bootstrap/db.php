<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

switch(getenv('DB_CONNECTION')) {
    case 'sqlite':
        $capsule->addConnection([
            'driver'   => 'sqlite',
            'database' => getenv('SQLITE_PATH'),
            'prefix'   => '',
        ]);
        break;
    case 'mysql':
        $capsule->addConnection([
            'driver'        => 'mysql',
            'host'          => getenv('DB_HOST'),
            'database'      => getenv('DB_DATABASE'),
            'username'      => getenv('DB_USER'),
            'password'      => getenv('DB_PASS'),
            'charset'       => 'utf8',
            'collation'     => 'utf8_unicode_ci',
            'prefix'        => ''

        ]);
        break;
}
$capsule->setAsGlobal();
$capsule->bootEloquent();
