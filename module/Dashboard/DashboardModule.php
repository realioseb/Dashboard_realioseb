<?php

namespace Dashboard;

class DashboardModule implements \Silex\ServiceProviderInterface, \Silex\ControllerProviderInterface
{
    public function boot(\Silex\Application $app)
    {
        $app['twig.loader.filesystem']->addPath(
            __DIR__.'/View',
            'Dashboard'
        );
    }

    public function register(\Silex\Application $app)
    {
        $app['dashboard.manager'] = $app->share(function () {
            return new \Dashboard\Controller\DashboardManager();
        });
    }

    public function connect(\Silex\Application $app)
    {
        $controllers = $app['controllers_factory'];
        
        $controllers->match("/test", "dashboard.manager:test")->bind('test');
        $controllers->match("/sidebar", "dashboard.manager:sidebar")->bind('sidebar'); 
        
        return $controllers;
    }

}
