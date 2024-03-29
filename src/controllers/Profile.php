<?php

namespace Ecasa\Instagram\controllers;

use Ecasa\Instagram\lib\Controller;
use Ecasa\Instagram\models\User;

class Profile extends Controller
{
    public function __construct(){
        parent::__construct();
    }

    public function getUserProfile(User $user){
        $user->fetchPosts();
        $this->render('profile/index',['user'=>$user]);
    }
    public function getUsernameProfile(string $username){
        $user = User::get($username);
        $this->getUserProfile($user);
    }

}