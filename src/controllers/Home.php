<?php 

namespace Ecasa\Instagram\controllers;


use Ecasa\Instagram\lib\Controller;
use Ecasa\Instagram\models\User;
use Ecasa\Instagram\lib\UtilImages;
use Ecasa\Instagram\models\PostImage;


class Home extends Controller {


    public function __construct(private User $user){
        parent::__construct();
    }

    public function index(){
        $posts = PostImage::getFeed(); //Cuando se utiliza :: es poque es static el metodo
        $this->render('home/index',['user' => $this->user]); //Con la función render se envia un parametros a la vista
    }

    public function store(){
        $title = $this->post('title');
        $image = $this->file('image');
        // dd($title, $image);
        if(!is_null($title) && !is_null($image)){
            $filename = UtilImages::storeImage($image);

            $post  = new PostImage($title,$filename);
            $this->user->publish($post);
            header('location:/instagram/home');

        }else{
            header('location:/instagram/home');
        }

    }
}