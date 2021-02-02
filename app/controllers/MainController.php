<?php


namespace app\controllers;


class MainController
{
    public function __construct()
    {
        echo 'MainController';
    }

    public function index()
    {
        echo 'MainController::index';
    }

    public function test()
    {
        echo 'MainController::test';
    }
}