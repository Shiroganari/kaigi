<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Core/Config/errorsHandling.php';
require_once __DIR__ . '/../Core/Config/routes.php';

$router->dispatch($_SERVER['QUERY_STRING']);