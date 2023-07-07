<?php


namespace Ecasa\Instagram\models;

use Ecasa\Instagram\models\Post;
use Ecasa\Instagram\lib\Database;
use Ecasa\Instagram\models\User;
use PDO;
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
            $db = new Database();
            $query = $db->connect()->query("SELECT * FROM posts ORDER BY  post_id DESC");
            
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                
                $item = new PostImage($p['title'],$p['media']);
                $item->setId($p['post_id']);
                $item->fetchLikes();
               

                $user = User::getById($p['user_id']);
                $item->setUser($user);

                array_push($items,$item);
            }
            

            return $items;
        }catch(PDOException $e){
            return [];
        }

        
    }
}