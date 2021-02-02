<?php


namespace app\controllers;

use system\core\Controller;

class MainController extends Controller
{

    public function indexAction()
    {
        pr($this->route);
    }

    public function testAction()
    {
        pr($this->route);
    }


}