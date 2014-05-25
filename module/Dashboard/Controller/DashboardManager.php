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
    
    public function dashboard(Application $app)
    {
        //user_id must be the current user logged in
        $user_id = 1;
        $widgets = \db_functions::db_select('custom_widget', array('user_id' => $user_id), 'and');
        
        return $app['twig']->render('@Dashboard/dashboard.twig', array(
            'widgets' => $widgets,
        ));
    }
    
    public function register(Application $app)
    {
        $data = array();
        
        $status = false;
        
        if($_POST['checkPassword'] == $user['password'] = $_POST['password']) {
            $data['username'] = $_POST['uname'];
            $data['email'] = $_POST['mail'];
            $data['password'] = md5($_POST['password']);
            
            \db_functions::db_insert('users', $data);
            
            $status = true;
        }
        
        return json_encode($status);
    }
}
