<?php
$controller = null;
$method = null;
include __DIR__ . '/../bootstrap/start.php';
include __DIR__ . '/../App/libs/functions/functions.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();
include __DIR__ . '/../bootstrap/db.php';
//routes file
include __DIR__ . '/../routes.php';

$match = $router->match();


if (is_string($match['target'])) {
    list($controller, $method) = explode('@', $match['target']);
}

if (($controller != null) && (is_callable([$controller, $method])) ) {
    $object = new $controller();
    call_user_func_array([$object, $method], [$match['params']]);
} elseif ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
   echo "Cannot find {$controller}->{$method}";
//    redirect(404);
    exit;
}
