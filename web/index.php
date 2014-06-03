<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

// required files
require __DIR__.'/../app/config.php';
require __DIR__.'/../app/app.php';

// routing
$app->mount('/', new \Dashboard\DashboardModule());
$app->mount('/', new \Database\DatabaseModule());

$app->run();