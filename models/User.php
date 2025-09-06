<?php 
class User{
    
    private string $login; 
    private string $email;
    private string $password; 

    public function __construct($login, $email, $password){
        $this->login = $login; 
        $this->email = $email; 
        $this->password = $password; 
    }

    public function getLogin(){
        return $this->login; 
    }

    public function setLogin($login){
        $this->login = $login; 
    }

    public function getEmail(){
        return $this->email; 
    }

    public function setEmail($email){
        $this->email = $email; 
    }

    public function getPassword(){
        return $this->password; 
    }

    public function setPassword($password){
        $this->password = $password; 
    }

    public static function GetUser(){ 
        $connexion = connexionBdd() ; 
        $requete = $connexion->prepare("SELECT login,email, password FROM user") ; 
        $requete->execute() ; 
        $users = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
        return $users ; 
    }

    public static function getByEmail($email){
        $connexion = connexionBdd() ; 
        $requete = $connexion->prepare("SELECT user_id, login,email, password FROM user WHERE email = :email") ; 
        $requete->bindParam(':email', $email, PDO::PARAM_STR) ; 
        $requete->execute() ; 
        $user = $requete->fetch(PDO::FETCH_ASSOC) ; 
        return $user ; 
    }

    public static function create($login,$email, $password){
        try{
            $connexion = connexionBdd() ; 
            $hash = password_hash($password, PASSWORD_ARGON2ID);
            $requete = $connexion->prepare("INSERT INTO `user`(user_id, login, email, password, created_at, updated_at)  VALUES(Null, :login,:email,  :password, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
            $requete->bindParam(':login', $login, PDO::PARAM_STR) ; 
            $requete->bindParam(':email',$email, PDO::PARAM_STR);
            $requete->bindParam(':password', $hash, PDO::PARAM_STR) ; 
            $requete->execute() ; 

            $user_id = $connexion->lastInsertId();
            return new User($user_id, $login, $email, $hash, new DateTime(), new DateTime());
        }catch(PDOException $e){
            echo "erreur de create ".$e ; 
        }
    }


    public static function update($titre, $auteur, $disponible,$pageNumber){
        try{
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("UPDATE `book` `title`=:title, `author`=:author, `disponibility`=:disponibility, `pageNumber`=:pageNumber CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
            $requete->bindParam(':title', $titre, PDO::PARAM_STR) ; 
            $requete->bindParam(':author', $auteur, PDO::PARAM_STR) ; 
            $requete->bindParam(':disponible', $disponible, PDO::PARAM_BOOL) ; 
            $requete->bindParam(':pageNumber', $pageNumber, PDO::PARAM_INT) ; 
            $requete->execute() ; 
        }catch(PDOException $e){
            echo "erreur de modification ".$e ; 
        }
    }

    public static function delete($id){ 
        try{
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("DELETE FROM `book` WHERE `book_id` = :id"); 
            $requete->bindParam(':id',$id,PDO::PARAM_INT); 
            $requete->execute() ; 
        }catch(PDOException $e){
            echo "Erreur de suppression".$e ; 
        }
    }


}