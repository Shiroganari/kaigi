<?php

use Core\Router;

$router = new Router();

// Intro
$router->add('', ['controller' => 'intro', 'action' => 'index']);
$router->add('home', ['controller' => 'home', 'action' => 'index']);

// Auth
$router->add('registration', ['controller' => 'auth', 'action' => 'registrationPage']);
$router->add('login', ['controller' => 'auth', 'action' => 'loginPage']);
$router->add('complete-registration', ['controller' => 'auth', 'action' => 'completeRegistrationPage']);
$router->add('auth/registration', ['controller' => 'auth', 'action' => 'registration']);
$router->add('auth/login', ['controller' => 'auth', 'action' => 'login']);
$router->add('auth/logout', ['controller' => 'auth', 'action' => 'logout']);
$router->add('auth/completeRegistration', ['controller' => 'auth', 'action' => 'completeRegistration']);

// Users
$router->add('user/{id:\d+}', ['controller' => 'profile', 'action' => 'index']);
$router->add('users', ['controller' => 'users', 'action' => 'showUsers']);
$router->add('users/changeUserStatus', ['controller' => 'users', 'action' => 'changeUserStatus']);

// Events
$router->add('events', ['controller' => 'events', 'action' => 'index']);
$router->add('events/showEvents', ['controller' => 'events', 'action' => 'showEvents']);
$router->add('event/create-event', ['controller' => 'event', 'action' => 'createEvent']);
$router->add('event/event-participation', ['controller' => 'event', 'action' => 'eventParticipation']);
$router->add('event/kick-member', ['controller' => 'event', 'action' => 'kickMember']);
$router->add('event/{id:\d+}', ['controller' => 'event', 'action' => 'index']);
$router->add('my-events', ['controller' => 'events', 'action' => 'myEventsPage']);
$router->add('new-event', ['controller' => 'event', 'action' => 'EventCreationPage']);

//Groups
$router->add('groups', ['controller' => 'groups', 'action' => 'index']);
$router->add('groups/showGroups', ['controller' => 'groups', 'action' => 'showGroups']);
$router->add('group/create-group', ['controller' => 'group', 'action' => 'createGroup']);
$router->add('group/group-participation', ['controller' => 'group', 'action' => 'groupParticipation']);
$router->add('group/kick-member', ['controller' => 'group', 'action' => 'kickMember']);
$router->add('group/{id:\d+}', ['controller' => 'group', 'action' => 'index']);
$router->add('my-groups', ['controller' => 'groups', 'action' => 'myGroupsPage']);
$router->add('new-group', ['controller' => 'group', 'action' => 'GroupCreationPage']);

// Services
$router->add('report/send-report', ['controller' => 'report', 'action' => 'sendReport']);
$router->add('topics/get-all-topics', ['controller' => 'topics', 'action' => 'getAllTopics']);