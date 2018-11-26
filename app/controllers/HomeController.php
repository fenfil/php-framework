<?php

namespace App\Controllers;

use Core\Base\Controller;

class HomeController extends Controller
{
    public function index()
    {
        echo 'TEST';
    }

    public function hello($name)
    {
        echo "Hello, {$name}!";
    }

    public function page()
    {
        return $this->render('index');
    }
}
