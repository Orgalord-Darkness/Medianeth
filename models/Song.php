<?php 
class Song {
    
    private string $title; 
    private Album $album; 
    private int $note; 
    private float $duration; 

    public function __construct($title, $album, $note,$duration){
        $this->title = $title; 
        $this->album=$album; 
        $this->note = $note; 
        $this->duration=$duration;
    }

    public static function GetSong(){ 
        $connexion = connexionBdd() ; 
        $requete = $connexion->prepare("SELECT song_id, title,album_id,note,duration FROM song") ; 
        $requete->execute() ; 
        $books = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
        return $books ; 
    }

    public static function GetSongById($id){
        $connexion = connexionBdd() ; 
        $requete = $connexion->prepare("SELECT SELECT song_id, title,album_id,note,duration FROM song WHERE song_id = :id") ; 
        $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
        $requete->execute() ; 
        $book = $requete->fetch(PDO::FETCH_ASSOC) ; 
        return $book ; 
    }

    public static function create($title, $album_id, $note,$duration){
        try{
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("INSERT INTO `song`(song_id, title, note, duration,album_id,created_at,updated_at) VALUES(Null, :title, :note, :duration, :album_id, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
            $requete->bindParam(':title', $title, PDO::PARAM_STR) ; 
            $requete->bindParam(':note', $note, PDO::PARAM_INT) ; 
            $requete->bindParam(':duration', $duration, PDO::PARAM_INT) ; 
            $requete->bindParam(':album', $album_id, PDO::PARAM_STR) ; 
            $requete->execute() ; 
        }catch(PDOException $e){
            echo "erreur de create ".$e ; 
        }
    }

    public static function update($id,$title, $album_id, $note,$duration){
        try{
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("UPDATE `song` SET title=:title , note=:note, duration=:duration,album_id=:album_id,updated_at=CURRENT_TIMESTAMP  WHERE song_id=:id") ; 
            $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
            $requete->bindParam(':title', $title, PDO::PARAM_STR) ; 
            $requete->bindParam(':note', $note, PDO::PARAM_INT) ; 
            $requete->bindParam(':duration', $duration, PDO::PARAM_INT) ; 
            $requete->bindParam(':album', $album_id, PDO::PARAM_STR) ; 
            $requete->execute() ; 
        }catch(PDOException $e){
            echo "erreur de create ".$e ; 
        }
    }


    public static function delete($id){ 
        try{
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("DELETE FROM `song` WHERE `song_if` = :id"); 
            $requete->bindParam(':id',$id,PDO::PARAM_INT); 
            $requete->execute() ; 
        }catch(PDOException $e){
            echo "Erreur de suppression".$e ; 
        }
    }
    
}