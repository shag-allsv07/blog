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
        $url = self::removeQueryString($url); // убираем явные GET параметры

        foreach (self::$routers as $key => $val){
            if (preg_match("#$key#i", $url, $matches)) { // если есть совпадение с регулярным выражением, то записываем в $rout = текущее значение таблицы маршрутов routers, а так-же записываем текущий маршрут в массив matches
                $rout = $val;

                foreach ($matches as $k => $match){ // записываем в массив rout только строковые ключи массива matches
                    if(is_string($k)){
                       $rout[$k] = $match;
                   }
               }

               $rout['controller'] = self::upperStr($rout['controller']); // привели в правильное название класс

               if(!isset($rout['action'])){ // если в адресной строке пришел только контроллер (http://blog/news), то дописываем в rout метод index
                   $rout['action'] = 'index';
               }

                self::$route = $rout; // записываем в свойство текущий маршрут

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
                $obj = new $controller(self::$route); // создаем обьект класса
                $action = self::lowerStr(self::$route['action']) . 'Action'; // привели в правильное название метод
                //pr(self::$route);
                if (method_exists($obj, $action)){
                    $obj->$action(); // вызываем метод класса
                }
                else {
                    echo "Метод $action не найден";
                }
            }
            else {
                echo "Контроллер $controller не найден";
            }
        }
        else {
            http_response_code(404);
            include '404.html';
        }
    }

    /**
     * метод отсекает явные GET параментры -> ?Page=1. неявыные GET параметры Main/test....
     * @param $url
     * @return mixed
     */
    private static function removeQueryString($url)
    {
        if ($url != ''){
            $params = explode('&', $url);

            if (strpos($params[0], '=') === false){
                return $params[0];
            }
            else {
                return '';
            }
        }

        return $url;
    }

    private static function upperStr($str)
    {
        $str = str_replace("-", " ", $str);
        $str = ucwords($str);
        $str = str_replace(" ", "", $str);

        return $str;
    }

    private static function lowerStr($str)
    {
        return lcfirst(self::upperStr($str));
    }
}