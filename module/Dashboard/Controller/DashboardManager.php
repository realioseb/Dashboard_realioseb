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
        $widgets = $app['database.abstraction']->db_select('custom_widget', array('user_id' => $user_id), $app);
        
        return $app['twig']->render('@Dashboard/dashboard.twig', array(
            'widgets' => $widgets,
        ));
    }
    
    public function register(Application $app)
    {
        $data = array();
        
        if (!empty($app['database.abstraction']->db_select('users', array('username' => $_POST['uname']), $app))) {
            return json_encode(2);
        }
        
        if($_POST['checkPassword'] == $_POST['password']) {
            $data['username'] = $_POST['uname'];
            $data['email'] = $_POST['mail'];
            $data['password'] = md5($_POST['password']);

            $app['database.abstraction']->db_insert('users', $data, $app);
            
            return json_encode(1);
        } else {
            return json_encode(3);
        }
        
        return json_encode(null);
    }
}
