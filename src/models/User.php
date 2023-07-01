<?php

namespace Ecasa\Instagram\models;
use Ecasa\Instagram\lib\Model;

use PDO;
use PDOException;

class User extends Model{

    private int $id;
    private array $posts;
    private string $profile;
    
    public function __construct(private string $username, private string $password)
    {
        $this->posts = [];
        $this->profile = "";
        $this->id = -1;

   }

   public function save(){
        try {
            //TODO:Validar si existe primero el usuario
            $hash = $this->getHashedPassword($this->password);
            $query = $this->prepare('INSERT INTO users (username, password, profile) VALUES(:username,:password,:profile)');// se utilizan dos puntos para mas adelante cambiarlo
            $query->execute([
                'username' => $this->username,
                'password'=> $hash,
                'profile'=> $this->profile,

            ]);
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
   }

   private function getHashedPassword($password){
        return password_hash($password, PASSWORD_DEFAULT,['cost' => 10]);
   }

   public function getId()
   {
        return $this->id; 
   }

   public function  setId($value)
   {
        $this->id = $value;
   }
   
   public function getUsername()
   {
        return $this->username; 
   }

   public function  setUsername($value)
   {
        $this->id = $value;
   }

   public function getPosts()
   {
        return $this->posts;
   }

   public function setPosts($value)
   {
        $this->posts = $value;
   }
   
   public function getProfile()
   {
        return $this->profile;
   }

   public function setProfile($value)
   {
        $this->profile = $value;
   }
}