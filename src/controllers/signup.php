<?php 

namespace Ecasa\Instagram\controllers;

use Ecasa\Instagram\lib\Controller;
use Ecasa\Instagram\lib\UtilImages;
use Ecasa\Instagram\models\User;



class Signup extends Controller{

    public function __construct(){
        parent::__construct(); // Llamando al constructor del padre
    }

    public function register()
    {
        $username = $this->post('username');
        $password = $this->post('password');
        $profile = $this->file('profile');

        if(!is_null($username) && !is_null($password) && !is_null($profile))
        {
            $pictureName = UtilImages::storeImage($profile);
            $user = new User($username,$password);
            $user->setProfile($pictureName);
            $user->save();
            header('location: /instagram/login');
        }else{
            $this->render('errors/index');
        }
    }
    
}
 
