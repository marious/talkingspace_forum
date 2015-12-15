<?php

$router->map('GET', '/', 'App\controllers\HomeController@showIndex', 'home');
$router->map('POST', '/', 'App\controllers\AuthenticationController@postLogin', 'login');
$router->map('GET', '/topics', 'App\controllers\TopicController@showTopics', 'topics');
$router->map('GET', '/topics/category/[:action]', 'App\controllers\TopicController@showCategoryTopics', 'categoryTopics');
$router->map('GET', '/topic/[i:id]', 'App\controllers\TopicController@showTopic', 'topic');

if (userLoggedIn() != false) {
    $router->map('GET', '/logout', 'App\controllers\AuthenticationController@logout', 'logout');
    $router->map('GET', '/topic/create', 'App\controllers\TopicController@showcreateTopic', 'createTopic');
    $router->map('POST', '/topic/create', 'App\controllers\TopicController@postCreateTopic', 'postcreateTopic');

    $router->map('POST', '/topic/[i:id]', 'App\controllers\TopicController@postReply', 'postReply');

}

if (userLoggedIn() == false) {
    $router->map('GET', '/register', 'App\controllers\RegisterController@showRegister', 'register');
    $router->map('POST', '/register', 'App\controllers\RegisterController@postRegister', 'postRegister');
    $router->map('GET', '/captcha', 'App\controllers\HomeController@showCaptcha');

}







