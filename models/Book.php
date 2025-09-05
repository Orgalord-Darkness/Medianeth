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
        $requete = $connexion->prepare("SELECT titre,auteur,disponible,pageNumber FROM book") ; 
        $requete->execute() ; 
        $books = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
        return $books ; 
    }

    public static function GetBookById($id){
        $connexion = connexionBdd() ; 
        $requete = $connexion->prepare("SELECT titre,auteur,disponible,pageNumber FROM book WHERE book_id = :id") ; 
        $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
        $requete->execute() ; 
        $book = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
        return $book ; 
    }

    public static function create($titre, $auteur, $disponible,$pageNumber){
        try{
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("INSERT INTO `book` VALUES(Null, :title, :author, :disponibility, :pageNumber CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
            $requete->bindParam(':title', $titre, PDO::PARAM_STR) ; 
            $requete->bindParam(':author', $auteur, PDO::PARAM_STR) ; 
            $requete->bindParam(':disponible', $disponible, PDO::PARAM_BOOL) ; 
            $requete->bindParam(':pageNumber', $pageNumber, PDO::PARAM_INT) ; 
            $requete->execute() ; 
        }catch(PDOException $e){
            echo "erreur de create ".$e ; 
        }
    }

    public static function update($titre, $auteur, $disponible,$pageNumber){
        try{
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("UPDATE `book` `titre`=:title, `auteur`=:author, `disponibility`=:disponibility, `pageNumber`=:pageNumber CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
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