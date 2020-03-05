<?php

require_once 'modules/Autoloader.php';

Autoloader::register();

use core\modules\Router;
use core\modules\Auth;

const DIRECTORY = __DIR__;
Auth::startSession();
$routes = require_once 'core/config/routes.php';

Router::run($routes);
