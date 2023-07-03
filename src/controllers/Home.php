<?php 

namespace Ecasa\Instagram\controllers;


use Ecasa\Instagram\lib\Controller;
use Ecasa\Instagram\models\User;

class Home extends Controller {


    public function __construct(private User $user){
        parent::__construct();
    }

    public function index(){
        $this->render('home/index',['user'=>$this->user]); //Con la función render se envia un parametros a la vista
    }
}