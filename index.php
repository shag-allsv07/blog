<?php
require_once 'system/core/functions.php';
require_once 'system/core/Router.php';

use system\core\Router;

pr($_REQUEST);


Router::getRouts('^(.*)$', 'news/index'); //2.34