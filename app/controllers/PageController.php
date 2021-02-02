<?php


namespace app\controllers;


class PageController
{
    public function __construct()
    {
        echo 'PageController';
    }

    public function index()
    {
        echo 'PageController::index';
    }

    public function test()
    {
        echo 'PageController::test';
    }
}