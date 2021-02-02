<?php
require '../system/core/functions.php';
require '../system/core/Router.php';
require '../app/controllers/MainController.php';
require '../app/controllers/PageController.php';

use system\core\Router;

$urlStr = $_SERVER['QUERY_STRING'];

//Router::add(['news' => ['controller' => 'news', 'action' => 'index']]);
//Router::add(['page/contact' => ['controller' => 'page', 'action' => 'contact']]);
//Router::add(['news/view' => ['controller' => 'news', 'action' => 'view']]);
Router::add(['^$' => ['controller' => 'Main', 'action' => 'index']]);
Router::add(['^(?P<controller>[a-z0-9-]+)/?(?P<action>[a-z0-9-]+)?$' => []]);


pr(Router::$routers);

Router::dispatch($urlStr);

//pr(Router::$route);