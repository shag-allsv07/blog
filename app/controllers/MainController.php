<?php


namespace app\controllers;

use system\core\Controller;

class MainController extends Controller
{
    public $layout = 'main';

    public function indexAction()
    {
        //$this->view = 'test';
        $this->setVars(['name' => 'vasya']);
    }

    public function testAction()
    {
        //pr($this->route);
    }


}