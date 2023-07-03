<?php

namespace Ecasa\Instagram\controllers;

use Ecasa\Instagram\lib\Controller;
use Ecasa\Instagram\models\User;

class Login extends Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function auth(){
        $username = $this->post('username');
        $password = $this->post('password');

        if(!is_null($username) && !is_null($password))
        {
            if(User::exists($username)){
                $user = User::getUser($username);
                if($user->comparePassword($password))
                {
                    $_SESSION['user'] = serialize($user);
                    error_log('User logged in');
                    header('location:/instagram/home');
                }else{
                    error_log('No es el mismo password');
                    header('location:/instagram/login');
                }
            }else{
                error_log('User not found');
                header('location:/instagram/login');
            }
        }else{
            header('location:/instagram/login');       
        }
    }
}