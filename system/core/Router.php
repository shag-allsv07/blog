<?php


namespace system\core;


class Router
{
    public static $routers = [];
    public static $route = [];


    /**
     * метод принимает путь (строку) и записывает в таблицу маршрутов (массив)
     * @param $route
     */
    public static function add($route)
    {
        foreach ($route as $key => $val){
            self::$routers[$key] = $val;
        }
    }

    /**
     * метод проверяет url на совпадение с ключом в таблице маршрутов и записывает совпадение в массив rout. и возвращает true или false
     * @param $url
     * @return bool
     */
    public static function checkRoute($url)
    {
        foreach (self::$routers as $key => $val){
            if (preg_match("#$key#i", $url, $matches)) {
                $rout = $val;

                foreach ($matches as $k => $match){
                    if(is_string($k)){
                       $rout[$k] = $match;
                   }
               }

               $rout['controller'] = self::upperStr($rout['controller']);

               if(!isset($route['action'])){
                   $rout['action'] = 'index';
               }
                self::$route = $rout;

               return true;
            }
        }

        return false;
    }


    /**
     * метод принимает строку (путь) и определяет находится этот путь в таблице (массиве) маршрутов
     * @param $path
     */
    public static function dispatch($path)
    {
        if (self::checkRoute($path)){
            $controller = 'app\controllers\\' . self::$route['controller'] . "Controller";

            if (class_exists($controller)){
                $obj = new $controller;
            }
            else {
                echo "Контроллер $controller не найден";
            }
        }
        else {
            echo '404';
        }
    }

    private static function upperStr($str)
    {
        $str = str_replace("-", " ", $str);
        $str = ucwords($str);
        $str = str_replace(" ", "", $str);

        return $str;
    }

    private static function lowerStr()
    {

    }
}