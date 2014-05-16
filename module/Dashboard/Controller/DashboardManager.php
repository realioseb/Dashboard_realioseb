<?php

namespace Dashboard\Controller;

use \Silex\Application;

class DashboardManager
{
    public function test(Application $app)
    {
        return $app['twig']->render('@Dashboard/test.twig', array(
            'test' => $test = array(
                'hello' => 'HELLO',
                'world' => 'WORLD'
            ),
        ));
    }
    
    public function sidebar(Application $app)
    {
        $categories = \db_functions::db_select('categories', array('1' => 1), 'or');
        
        foreach($categories as $key => $value) {
            $widgets = \db_functions::db_select('widgets', array('category_id' => $value['id']), 'and');
            $categories[$key]['widget'] = $widgets;
        }
        
        return $app['twig']->render('@Dashboard/sidebar.twig', array(
            'categories' => $categories,
        ));
    }
}
