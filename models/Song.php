<?php 
class Song {
    
    private string $title; 
    private int $note; 
    private float $duration; 
    private Album $album; 

    public function __construct($title, $note,$duration,$album){
        $this->title = $title; 
        $this->note = $note; 
        $this->duration=$duration;
         $this->album=$album; 
    }

    public static function GetSong(){ 
        $connexion = connexionBdd() ; 
        $requete = $connexion->prepare("SELECT song_id, title,album_id,note,duration FROM song") ; 
        $requete->execute() ; 
        $songs = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
        return $songs ; 
    }

    public static function GetSongById($id){
        $connexion = connexionBdd() ; 
        $requete = $connexion->prepare("SELECT song_id, title,album_id,note,duration FROM song WHERE song_id = :id") ; 
        $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
        $requete->execute() ; 
        $song = $requete->fetch(PDO::FETCH_ASSOC) ; 
        return $song ; 
    }

    public static function GetSongByAlbumId($id){
        $connexion = connexionBdd() ; 
        $requete = $connexion->prepare("SELECT song.song_id, song.title,song.album_id,song.note,song.duration FROM song INNER JOIN album ON song.album_id = album.album_id WHERE song.album_id = :id") ; 
        $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
        $requete->execute() ; 
        $song = $requete->fetch(PDO::FETCH_ASSOC) ; 
        return $song ; 
    }

    public static function create($title, $note,$duration, $album_id  ){
        try{
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("INSERT INTO `song`(song_id, title, note, duration,album_id,created_at,updated_at) VALUES(Null, :title, :note, :duration, :album, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
            $requete->bindParam(':title', $title, PDO::PARAM_STR) ; 
            $requete->bindParam(':note', $note, PDO::PARAM_INT) ; 
            $requete->bindParam(':duration', $duration, PDO::PARAM_INT) ; 
            $requete->bindParam(':album', $album_id, PDO::PARAM_INT) ; 
            $requete->execute() ; 
        }catch(PDOException $e){
            echo "erreur de create ".$e ; 
        }
    }

    public static function update($id,$title, $note,$duration,$album_id){
        try{
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("UPDATE `song` SET title=:title , note=:note, duration=:duration,album_id=:album,updated_at=CURRENT_TIMESTAMP  WHERE song_id=:id") ; 
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
            $requete = $connexion->prepare("DELETE FROM `song` WHERE `song_id` = :id"); 
            $requete->bindParam(':id',$id,PDO::PARAM_INT); 
            $requete->execute() ; 
        }catch(PDOException $e){
            echo "Erreur de suppression".$e ; 
        }
    }
    
}