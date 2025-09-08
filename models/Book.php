<?php 
class Book extends Media{
    
    private int $pageNumber; 

    public function __construct($titre, $auteur, $disponible,$pageNumber){
        $this->pageNumber = $pageNumber; 
        parent::__construct($titre, $auteur, $disponible);
    }

    public function getPageNumber(){
        return $this->pageNumber; 
    }

    public function setPageNumber($pageNumber){
        $this->pageNumber = $pageNumber; 
    }

    public function read(){
        $connexion = connexionBdd(); 

    }

    public static function GetBook(){ 
        $connexion = connexionBdd() ; 
        $requete = $connexion->prepare("SELECT book_id, title,author,disponibility,pageNumber FROM book") ; 
        $requete->execute() ; 
        $books = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
        return $books ; 
    }

    public static function GetBookById($id){
        $connexion = connexionBdd() ; 
        $requete = $connexion->prepare("SELECT book_id, title,author,disponibility,pageNumber FROM book WHERE book_id = :id") ; 
        $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
        $requete->execute() ; 
        $book = $requete->fetch(PDO::FETCH_ASSOC) ; 
        return $book ; 
    }

    public static function create($titre, $auteur, $disponible,$pageNumber){
        try{
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("INSERT INTO `book`(book_id, title, author, disponibility,pageNumber,created_at,updated_at) VALUES(Null, :title, :author, :disponibility, :pageNumber, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
            $requete->bindParam(':title', $titre, PDO::PARAM_STR) ; 
            $requete->bindParam(':author', $auteur, PDO::PARAM_STR) ; 
            $requete->bindParam(':disponibility', $disponible, PDO::PARAM_INT) ; 
            $requete->bindParam(':pageNumber', $pageNumber, PDO::PARAM_INT) ; 
            $requete->execute() ; 
        }catch(PDOException $e){
            echo "erreur de create ".$e ; 
        }
    }

    public static function update($id, $titre, $auteur, $disponible,$pageNumber){
        try{
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("UPDATE `book` SET `title`=:title, `author`=:author, `disponibility`=:disponibility, `pageNumber`=:pageNumber, `updated_at`=CURRENT_TIMESTAMP WHERE `book_id`=:id;") ; 
            $requete->bindParam(':id', $id, PDO::PARAM_INT) ;
            $requete->bindParam(':title', $titre, PDO::PARAM_STR) ; 
            $requete->bindParam(':author', $auteur, PDO::PARAM_STR) ; 
            $requete->bindParam(':disponibility', $disponible, PDO::PARAM_INT) ; 
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

    public static function rendre($id){
        try{
            $connexion = connexionBdd(); 
            $requete = $connexion->prepare("UPDATE `book` SET `disponibility` = 1 WHERE `book_id` = :id"); 
            $requete->bindParam(':id',$id,PDO::PARAM_INT); 
            $requete->execute() ;

        }catch(PDOException $e){
            echo "Erreur de suppression".$e ; 
        }
    }

    public static function emprunter($id){
        try{
            $connexion = connexionBdd(); 
            $requete = $connexion->prepare("UPDATE `book` SET `disponibility` = 0 WHERE `book_id` = :id"); 
            $requete->bindParam(':id',$id,PDO::PARAM_INT); 
            $requete->execute() ;

        }catch(PDOException $e){
            echo "Erreur de suppression".$e ; 
        }
    }
    
}