<?php

use Core\Router;

$router = new Router();

$router->add('', ['controller' => 'intro', 'action' => 'index']);
$router->add('home', ['controller' => 'home', 'action' => 'index']);
$router->add('login', ['controller' => 'auth', 'action' => 'loginPage']);
$router->add('report', ['controller' => 'report', 'action' => 'createReport']);
$router->add('registration', ['controller' => 'auth', 'action' => 'registrationPage']);
$router->add('new-event', ['controller' => 'event', 'action' => 'EventCreationPage']);
$router->add('new-group', ['controller' => 'group', 'action' => 'GroupCreationPage']);
$router->add('my-events', ['controller' => 'events', 'action' => 'myEventsPage']);
$router->add('my-groups', ['controller' => 'groups', 'action' => 'myGroupsPage']);
$router->add('user/{id:\d+}', ['controller' => 'profile', 'action' => 'index']);

$router->add('{controller}/{action}');
$router->add('{controller}', ['{controller}' => '{controller}', 'action' => 'index']);
$router->add('{controller}/{id:\d+}', ['{controller}' => '{controller}', 'action' => 'index']);