<?php

namespace app\controllers;

use core\base\Controller;

class SiteController extends Controller
{
    public function index()
    {
        return $this->render('index');
    }

    public function postTest()
    {
        if ($this->request->isPost()) {
            return json_encode([
                'message' => 'OK',
            ]);
        }
    }
}