<?php 

namespace Ecasa\Instagram\controllers;


use Ecasa\Instagram\lib\Controller;
use Ecasa\Instagram\models\PostImage;
use Ecasa\Instagram\models\User;
// use PDO;


class actions extends Controller {

    public function __construct(private User $user)
    {
        parent::__construct();
    }
    public function like(){
        $post_id = $this->post('post_id');
        $origin = $this->post('origin');


        if(!is_null($post_id) && !is_null($origin))
        {
            $post = PostImage::get($post_id);
            $post->addLike($this->user);

            header('Location:/instagram/' . $origin);
        }
    }
}