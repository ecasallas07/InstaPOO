<?php
use Ecasa\Instagram\controllers\Signup;
use Ecasa\Instagram\controllers\Login;
use Ecasa\Instagram\controllers\Home;

$router = new \Bramus\Router\Router();
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../config/');
$dotenv->load();

$router->get('/',function(){
    echo "Inicio";
});
$router->get('/login',function(){
    $controller = new Login();
    $controller->render('login/index');
});
$router->post('/auth',function(){
    $controller = new Login();
    $controller->auth('login/index');
});
$router->get('/signup',function(){

    $controller = new Signup();
    $controller->render('signup/index');

});
$router->post('/register',function(){
    $controller = new Signup();
    $controller->register();
});
$router->get('/home',function(){
    $user = unserialize($_SESSION['user']);
    $controller = new Home($user);
    $controller->index();
});
$router->post('/publish',function(){
    $user = unserialize($_SESSION['user']);
    $controller = new Home($user);
    $controller->store();
    header('location: home');
});
$router->get('/profile',function(){
    echo "Inicio";
});
$router->post('/addLike',function(){
    echo "Inicio";
});
$router->get('/singout',function(){
    echo "Inicio";
});
$router->get('/profile/{username}',function($username){
    echo "Inicio";
});
$router->run();