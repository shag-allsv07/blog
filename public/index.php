<?php
error_reporting(E_ALL);

require '../system/core/functions.php';

/**
 * системные константы
 */
define("ROOT", dirname(__DIR__));
define("LAYOUT", "default");


/**
 * функция автозагрузки классов
 */
spl_autoload_register(function ($class){
    $class = ROOT .'/'. str_replace('\\', '/', $class) . '.php';

    if (file_exists($class)){
        include $class;
    }
});


$urlStr = $_SERVER['QUERY_STRING'];

use system\core\Router;
//Router::add(['news' => ['controller' => 'news', 'action' => 'index']]);
//Router::add(['Page/contact' => ['controller' => 'Page', 'action' => 'contact']]);

//Router::add(['^(?P<controller>[a-z0-9-]+)/(?P<alias>[a-z0-9-]+)$' => []]);

Router::add(['^$' => ['controller' => 'Main', 'action' => 'index']]);
Router::add(['^(?P<controller>[a-z0-9-]+)/?(?P<action>[a-z0-9-]+)?$' => []]);


Router::dispatch($urlStr);

\system\core\DB::instance();