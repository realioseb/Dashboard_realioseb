<?php

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->register(new \Dashboard\DashboardModule());
$app->register(new \Database\DatabaseModule());