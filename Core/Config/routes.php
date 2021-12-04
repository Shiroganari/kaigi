<?php

use Core\Router;

$router = new Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('new-event', ['controller' => 'Event', 'action' => 'EventCreationPage']);

$router->add('{controller}/{action}');
$router->add('{controller}', ['{controller}' => '{controller}', 'action' => 'index']);
$router->add('{controller}/{id:\d+}', ['{controller}' => '{controller}', 'action' => 'index']);