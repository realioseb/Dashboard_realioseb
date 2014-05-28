<?php

$app['db.options'] = array(
    'driver'    => 'pdo_mysql',
    'host'      => 'localhost',
    'dbname'    => 'dashboard',
    'user'      => 'root',
    'password'  => '',
    'charset'   => 'utf8',
);

$app['debug'] = true;