<?php


namespace system\core;


class Router
{
    public static $routers = [];
    public static $rout;

    public function __construct()
    {
        echo 'Router';
    }


    /**
     * метод получает строку (путь) и записывает его в таблицу (массив) маршрутов
     * @param $pattern
     * @param $path
     */
    public static function getRouts($pattern, $path)
    {
        self::$routers[$pattern] = $path;
        pr(self::$routers);
    }

    /**
     * метод принимает строку (путь) и определяет находится этот путь в таблице (массиве) маршрутов
     * @param $path
     */
    public static function dispatch($path)
    {
        if(array_key_exists($path, self::$routers)) {
            $path = explode('/', );
        }
    }
}