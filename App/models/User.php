<?php

namespace App\models;

use App\libs\upload\Upload;
use Illuminate\Database\Capsule\Manager as DB;

class User
{

    public static $registerRules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users',
        'username' => 'required|min:3',
        'password' => 'required|min:3',
        'verify_password' => 'required|equalTo:password',
        'captcha' => 'captcha',
    ];


    public static function upload()
    {
        try {
            $destination = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/avatars/';
            $upload = new Upload($destination);
            $upload->upload();
            $errors = $upload->getMessages();
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }

        return $errors;
    }


    public static function create($data = array())
    {
        return DB::table('users')->insert($data);
    }



    public static function user($email)
    {
        return DB::table('users')->where('email', '=', $email)->first();
    }


    public static function count()
    {
        return DB::table('users')->count();
    }
}