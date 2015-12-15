<?php

namespace App\libs\auth;

class LoggedIn
{
    public static function User()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        } else {
            return false;
        }
    }
}