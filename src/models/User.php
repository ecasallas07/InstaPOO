<?php

namespace Ecasa\Instagram\models;
use Ecasa\Instagram\lib\Model;
use Ecasa\Instagram\lib\Database;

use PDO;
use PDOException;

class User extends Model{

    private int $id;
    private array $posts;
    private string $profile;
    
    public function __construct(private string $username, private string $password)
    {
        parent::__construct();
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


   public static function exists($username)  //Con static no se puede usar la variable $this cuando se pone static es porque no se necesita instanciar la funcion, por eso se laam con los dos puntos ejemplo User::exists
   {
     try{
          $db = new Database();
          $query = $db->connect()->prepare('SELECT username FROM users WHERE username = :username');
          $query->execute(['username' => $username]);

          // contar el numero de filas
          if($query->rowCount() > 0)
          {
               return true;
          }else{
               return false;
          }
     }catch(PDOException $e){
          error_log($e->getMessage());
          return false;
     }
   }

   public static function getUser($username): User
   {
     try{
          $db = new Database();
          $query = $db->connect()->prepare('SELECT * FROM users WHERE username = :username');
          $query->execute(['username' => $username]);

          // Guardar en una variable la informacion de la consulta
          $data = $query->fetch(PDO::FETCH_ASSOC);
          $user = new User($data['username'], $data['password']);
          $user->setId($data['user_id']);
          $user->setProfile($data['profile']);
          
          return $user;
     }catch(PDOException $e){
          error_log($e->getMessage());
          return $user;
     }
   }

   public function comparePassword(string $password): bool {
     return password_verify($password, $this->password);
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