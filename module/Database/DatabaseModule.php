<?php

namespace Database;

use Silex\Application;

class DatabaseModule implements \Silex\ServiceProviderInterface, \Silex\ControllerProviderInterface
{
    public function boot(Application $app)
    {
        
    }

    public function register(Application $app)
    {
        $app['database.abstraction'] = $app->share(function () use ($app) {
            return new \Database\Controller\DatabaseManager($app);
        });
    }

    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];
        
        return $controllers;
    }

}
