<?php


namespace Ecasa\Instagram\models;

use Ecasa\Instagram\models\Post;
use PDOException;
class PostImage extends Post{
    
    public function __construct(private string $title,private string $image ){
        parent::__construct($title);
    }
    
    public function getImage(){
        return $this->image;
    }

    public static function getFeed():array{
        $items = array();
        try{

        }catch(PDOException $e){

        }
        
    }
}