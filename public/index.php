<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;

error_reporting(E_ALL);
ini_set('display_errors', 'On');

$router = new Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

$router->dispatch($_SERVER['QUERY_STRING']);