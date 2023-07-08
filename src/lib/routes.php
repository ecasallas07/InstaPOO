<?php
use Ecasa\Instagram\controllers\Signup;
use Ecasa\Instagram\controllers\Login;
use Ecasa\Instagram\controllers\Home;
use Ecasa\Instagram\controllers\Actions;
use Ecasa\Instagram\controllers\Profile;



$router = new \Bramus\Router\Router();
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../config/');
$dotenv->load();

function noAuth(){
    if(isset($_SESSION['user'])){
        header('Location: /instagram/login');
        exit();
    }
}

function auth(){
    if(isset($_SESSION['user'])){
        header('Location: /instagram/home');
        exit();
    }
}

$router->get('/',function(){
    echo "Inicio";
});
$router->get('/login',function(){
    // auth();
    $controller = new Login();
    $controller->render('login/index');
});
$router->post('/auth',function(){
    // auth();
    $controller = new Login();
    $controller->auth('login/index');
});
$router->get('/signup',function(){
    // auth();
    $controller = new Signup();
    $controller->render('signup/index');

});
$router->post('/register',function(){
    // auth();
    $controller = new Signup();
    $controller->register();
});
$router->get('/home',function(){
    // noAuth();
    $user = unserialize($_SESSION['user']);
    $controller = new Home($user);
    $controller->index();
});
$router->post('/publish',function(){
    // noAuth();
    $user = unserialize($_SESSION['user']);
    $controller = new Home($user);
    $controller->store();
    header('location: home');
});
$router->get('/profile',function(){
    // noAuth();
    $user = unserialize($_SESSION['user']);
    $controller = new Profile();
    $controller->getUserProfile($user);
});
$router->post('/addLike',function(){
    // noAuth();
    $user = unserialize($_SESSION['user']);
    $controller = new Actions($user);
    $controller->like();
});
$router->get('/singout',function(){
    // noAuth();
   unset($_SESSION['user']); //Con unset elimina la variable
   header('Location:/instagram/login');
});
$router->get('/profile/{username}',function($username){
    // noAuth();
    $controller = new Profile();
    $controller->getUsernameProfile($username);
});
$router->run();