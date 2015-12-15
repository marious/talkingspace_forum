<?php

namespace App\controllers;

use App\models\User;

class AuthenticationController extends  BaseController
{

    public function postLogin()
    {
        $token = isset($_POST['_token']) ? $_POST['_token'] : null;
        check_token($token);

        $okay = true;

        $email = $_POST['email'];
        $password = $_POST['password'];

        // lookup the user
        $user = User::user($email);

        if ($user != null) {
            // validate password
            if (!password_verify($password, $user->password)) {
                $okay = false;
            }
        } else {
            $okay = false;
        }

        if ($okay) {
            $_SESSION['user'] = $user;
            flash('success', ['you are Login successfully']);
            redirect('/');
        } else {
            flash('errors', ['Invalid Login or you not active your account']);
            redirect('/');
        }
    }


    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        redirect('/');
    }

}