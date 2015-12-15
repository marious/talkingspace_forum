<?php

function asset($file) {
    return 'http://marious.gdk.mx' . $file;
}

function formateDate($str) {
    return date('F j, Y g:i:s A', strtotime($str));
}

function redirect($location = null) {
    if ($location) {
        if (is_numeric($location)) {
            switch($location) {
                case 404:
                    header('HTTP/1.0 404 Not Found');
                    include dirname(__DIR__) . '/../../views/page-not-found.blade.php';
                    exit;
            }
        }

        header('Location: ' . $location);
        exit;
    }
}


function set_value($field) {
    if (isset($_REQUEST[$field])) {
        return $_REQUEST[$field];
    }
    return '';
}

function flash($name, $string = null) {

    if (isset($_SESSION[$name])) {
        $session = $_SESSION[$name];
        unset($_SESSION[$name]);
        return $session;
    } else {
        $_SESSION[$name] = $string;
    }
}


function display_erros()
{
    $output = '';
    if (isset($_SESSION['errors'])) {
        $output .= ' <ul class="alert alert-danger">';
        $output .= '<button type="button" class="close" data-dismiss="alert">
                          <span aria-hidden="true">&times;</span>
                          <span class="sr-only">Close</span>
                        </button>';
        foreach (flash('errors') as $error) {
            if (is_array($error)) {
                foreach ($error as $item) {
                    $output .= "<li>$item</li>";
                }
                continue;
            }
            $output .= " <li>$error</li>";

        }
        $output .= '</ul>';
        return $output;
    }

    return '';
}


function csrf_field()
{
    $token_value = $_SESSION['_token'] = md5(uniqid());
    return '<input type="hidden" name="_token" value="'. $token_value .'">';
}

function check_token($token)
{
    if ($token == null) {
        header('HTTP/1.0 400 Bad Request');
        exit;
    }

    if (isset($_SESSION['_token']) && $token == $_SESSION['_token']) {
        unset($_SESSION['_token']);
        return true;
    } else {
        header('HTTP/1.0 400 Bad Request');
        exit;
    }
}


function userLoggedIn() {
    if (isset($_SESSION['user'])) {
        return $_SESSION['user'];
    } else {
        return false;
    }
}