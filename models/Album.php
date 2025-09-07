<?php
    class Album extends Media{

        private int $songNumber; 
        private string $editor ; 

        public function __construct($titre, $auteur, $disponible,$songNumber, $editor){
            $this->songNumber = $songNumber; 
            $this->editor = $editor; 
            parent::__construct($titre, $auteur, $disponible);
        }

        public function getSongNumber(){
            return $this->songNumber; 
        }

        public function setSongNumber(int $songNumber){
            $this->songNumber = $songNumber; 
        }

        public function getEditor(){
            return $this->editor; 
        }

        public function setEditor(string $editor){
            $this->editor = $editor; 
        }

        public static function GetAlbum(){ 
        $connexion = connexionBdd() ; 
        $requete = $connexion->prepare("SELECT album_id,title,author,disponibility,songNumber,editor FROM album") ; 
        $requete->execute() ; 
        $albums = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
        return $albums ; 
    }

    public static function getAlbumById($id){
        $connexion = connexionBdd() ; 
        $requete = $connexion->prepare("SELECT album_id, title,author,disponibility,songNumber,editor FROM album WHERE album_id = :id") ; 
        $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
        $requete->execute() ; 
        $album = $requete->fetch(PDO::FETCH_ASSOC) ; 
        return $album ; 
    }

    public static function create($titre, $auteur, $disponible,$songNumber, $editor){
        try{
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("INSERT INTO `album`(album_id, title, author, disponibility,songNumber,editor, created_at,updated_at) VALUES(Null, :title, :author, :disponibility, :songNumber, :editor, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
            $requete->bindParam(':title', $titre, PDO::PARAM_STR) ; 
            $requete->bindParam(':author', $auteur, PDO::PARAM_STR) ; 
            $requete->bindParam(':disponibility', $disponible, PDO::PARAM_INT) ; 
            $requete->bindParam(':songNumber', $songNumber, PDO::PARAM_INT) ;
            $requete->bindParam(':editor', $editor, PDO::PARAM_STR) ; 
            $requete->execute() ; 
        }catch(PDOException $e){
            echo "erreur de create ".$e ; 
        }
    }

    public static function update($id, $titre, $auteur, $disponible,$songNumber, $editor){
        try{
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("UPDATE `album` SET `title`=:title, `author`=:author, `disponibility`=:disponibility, `songNumber`=:songNumber,`editor`=:editor, `updated_at`=CURRENT_TIMESTAMP WHERE album_id = :id;") ; 
            $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
            $requete->bindParam(':title', $titre, PDO::PARAM_STR) ; 
            $requete->bindParam(':author', $auteur, PDO::PARAM_STR) ; 
            $requete->bindParam(':disponibility', $disponible, PDO::PARAM_INT) ; 
            $requete->bindParam(':songNumber', $songNumber, PDO::PARAM_INT) ;
            $requete->bindParam(':editor', $editor, PDO::PARAM_STR) ; 
            $requete->execute() ; 
        }catch(PDOException $e){
            echo "erreur de modification ".$e ; 
        }
    }

    public static function delete($id){ 
        try{
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("DELETE FROM `album` WHERE `album_id` = :id"); 
            $requete->bindParam(':id',$id,PDO::PARAM_INT); 
            $requete->execute() ; 
        }catch(PDOException $e){
            echo "Erreur de suppression".$e ; 
        }
    }


    }