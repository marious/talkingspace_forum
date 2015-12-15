<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();

// prettry error handler
$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
$whoops->register();

// routing handler
$router = new AltoRouter();


$router->setBasePath('/talkingspace/public');





