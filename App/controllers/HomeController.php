<?php

namespace App\controllers;

use App\libs\captcha\Captcha;
use App\models\Topic;
use App\libs\pagination\Pagination;

class HomeController extends BaseController
{
    public function showIndex()
    {
        // the current page number
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $perPage = 4;
        $totalCount = Topic::count();
        $pagination = new Pagination($page, $perPage, $totalCount);

        $topics = Topic::allTopics($perPage, $pagination->offset()) OR redirect(404);


        echo $this->blade->render('home', compact('topics', 'pagination'));
    }



    public function showCaptcha()
    {
        Captcha::create();
        header('content-type: image/jpeg');
    }
}