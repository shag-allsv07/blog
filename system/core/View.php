<?php


namespace system\core;


class View
{
    public $route = [];
    public $view;
    public $layout;

    public function __construct($route, $layout = "", $view = "")
    {
        $this->route = $route;
        $this->layout = $layout ?: LAYOUT; // если layout не пустой то присвоить его, если пустой то присвоить дефолтное значение
        $this->view = $view;
    }


    /**
     * Метод формирует путь к представлению и подключает его
     */
    public function render($vars)
    {
        extract($vars);

        ob_start();

        // /app/views/Main/index.php
        $path_view = ROOT . '/app/views/' . $this->route['controller'] . '/' . $this->view . '.php';

        if(file_exists($path_view)){
            require $path_view;
        }
        else {
            echo 'Представление ' . $path_view . ' не найдено';
        }

        $content = ob_get_clean();

        // /app/views/layouts/default.php
        $path_layout = ROOT . '/app/views/layouts/' . $this->layout . '.php';

        if (file_exists($path_layout)){
            require $path_layout;
        }
        else {
            echo 'Шаблон ' . $this->layout . ' не найден';
        }
    }
}