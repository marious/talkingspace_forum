<?php

namespace App\controllers;

use duncan3dc\Laravel\BladeInstance;

class BaseController
{
    protected $blade;

    public function __construct()
    {
        $this->blade = new BladeInstance(getenv('VIEWS_DIRECTORY'), getenv('CACHE_DIRECTORY'));
    }
}

