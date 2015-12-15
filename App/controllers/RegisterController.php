<?php

namespace App\controllers;

use App\libs\validation\Validator;
use App\models\User;

class RegisterController extends BaseController
{

    public function showRegister()
    {
        echo $this->blade->render('register');
    }


    public function postRegister()
    {
        $validator = new Validator();

        $errors = $validator->isValid(User::$registerRules);

        $avatar_name = $_FILES['avatar']['name'];


        if (sizeof($errors) == 0 && $avatar_name != '') {
            $errors = User::upload();
        }

        if (sizeof($errors) > 0) {
            flash('errors', $errors);
            echo $this->blade->render('register');
            exit;
        }

        $avatar = ($avatar_name != '') ? $avatar_name : 'no-image.png';

        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'username' => $_POST['username'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'avatar' => $avatar,
            'about' => $_POST['about'],
            'join_date' => date('Y-m-d H:i:s'),
            'access_level' => 0,
        ];

        if (User::create($data)) {
            flash('success', ['You are registered successfully Please check your email to activate your accout']);
            redirect('/');
        }

    }

}