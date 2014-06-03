<?php

namespace Dashboard\Controller;

use \Silex\Application;

class DashboardManager
{
    public function dashboard(Application $app)
    {
        //user_id must be the current user logged in
        $user_id = 1;
        $widgets = $app['database.abstraction']->db_select('custom_widget', array('user_id' => $user_id), $app);
        
        $user = array();
        
        if(isset($_SESSION)) {
            $user = $_SESSION;
        }
        
        
        return $app['twig']->render('@Dashboard/dashboard.twig', array(
            'widgets' => $widgets,
            'session' => $user,
        ));
    }
    
    public function register(Application $app)
    {
        $data = array();
        
        if (!empty($app['database.abstraction']->db_select('users', array('username' => $_POST['uname']), $app))) {
            return json_encode('2');
        }
        
        if($_POST['checkPassword'] == $_POST['password']) {
            $data['username'] = $_POST['uname'];
            $data['email'] = $_POST['mail'];
            $data['password'] = md5($_POST['password']);

            $app['database.abstraction']->db_insert('users', $data, $app);
            
            return json_encode('1');
        } else {
            return json_encode('3');
        }
        
        return json_encode('0');
    }
    
    public function login(Application $app)
    {
        $data['username'] = $_POST['uname'];
        $data['password'] = md5($_POST['password']);
        
        $result = $app['database.abstraction']->db_select('users', $data, $app);
        $user = $result[0];
        
        
        if(isset($user)) {
            session_start();
            
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['username'];
            $_SESSION['mail'] = $user['email'];
            
            return json_encode('1');
        }
        
        return json_encode('0');
    }
    
    public function widget($id, Application $app)
    {
        $options = array(
            1 => array(
                'header' => 'Weather',
                'content' => 'Hot and Cold',
                'footer' => 'go away!'
            ),
            2 => array(
                'header' => 'Calculator',
                'content' => 'some buttons and inputs are coming'
            )
        );
        
        header("Content-Type: application/json");
        return json_encode($options[$id]);
    }
}
