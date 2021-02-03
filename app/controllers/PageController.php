<?php


namespace app\controllers;

use system\core\Controller;

class PageController extends Controller
{

    public function indexAction()
    {
        $this->view = 'test';
    }

    public function testAction()
    {
        //echo 'PageController::test';
    }
}