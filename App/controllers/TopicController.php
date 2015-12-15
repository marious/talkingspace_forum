<?php

namespace App\controllers;

use App\libs\validation\Validator;
use App\models\Replies;
use App\models\Topic;

class TopicController extends BaseController
{

    public function showTopic($id)
    {
        $id = (int) $id['id'];

        $topic = Topic::topic($id) OR redirect(404);

        $replies = Replies::getRepliesForTopic($id);

        $_SESSION['current_page'] = '/topic/' . $id;

        echo $this->blade->render('topic', compact('topic', 'replies'));
    }

    public function showTopics()
    {
        $topics = Topic::allTopics();

        echo $this->blade->render('topics', compact('topics'));
    }

    public function showCategoryTopics($name)
    {

        $name = isset($name) ? urldecode($name['action']) : show(404);

        $topics = Topic::getTopicByCategory($name) OR redirect(404);

        $singleTopic = $topics[0];

        echo $this->blade->render('category-topics', compact('topics', 'singleTopic'));
    }


    public function showcreateTopic()
    {
        echo $this->blade->render('create-topic');
    }


    public function postCreateTopic()
    {
        $validator = new Validator();
        $errors = $validator->isValid(Topic::$createTopicRules);

        if (sizeof($errors) > 0) {
            flash('errors', $errors);
            echo $this->blade->render('create-topic');
            exit;
        }

        $data = [
            'title' => $_POST['title'],
            'body' => strip_tags($_POST['body']),
            'category_id' => $_POST['category'],
            'user_id' => userLoggedIn()->id,
        ];

       if (Topic::create($data)) {
           flash('success', ['new topic created successfully']);
           redirect('/');
       }
    }

    public function postReply()
    {
        $validation = new Validator();
        $errors = $validation->isValid(Replies::$rules);

        if (sizeof($errors) > 0) {
            flash('errors', $errors);
            redirect($_SESSION['current_page']);
        }

        $data = [
            'topic_id' => $_POST['topic_id'],
            'user_id' => userLoggedIn()->id,
            'body'  => strip_tags($_POST['body']),
        ];

        if (Replies::create($data)) {
            flash('success', ['reply added successfully']);
            redirect($_SESSION['current_page']);
        }
    }
}
