<?php 
    /**
     * Classe Song
     *
     * Représente une chanson contenue dans un album.
     *
     * Attributs :
     * @property string $title Titre de la chanson
     * @property int $note Note sur 5 de la chanson
     * @property float $duration Durée en minutes de la chanson
     * @property Album $album Album auquel la chanson appartient
     *
     * Constructeur :
     * @param string $title Titre de la chanson
     * @param int $note Note sur 5
     * @param float $duration Durée en minutes
     * @param Album $album Album parent
     *
     * Méthodes SQL :
     * @method static array GetSong() Récupère toutes les chansons
     * @method static array|null GetSongById(int $id) Récupère une chanson par son ID
     * @method static array GetSongByAlbumId(int $id) Récupère toutes les chansons d'un album par ID d'album
     * @method static void create(string $title, int $note, float $duration, int $album_id) Crée une nouvelle chanson
     * @method static void update(int $id, string $title, int $note, float $duration, int $album_id) Met à jour une chanson existante
     * @method static void delete(int $id) Supprime une chanson par son ID
     */
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
            $requete = $connexion->prepare("SELECT song_id, title,album_id,note,duration FROM songs") ; 
            $requete->execute() ; 
            $songs = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
            return $songs ; 
        }

        public static function GetSongById($id){
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("SELECT song_id, title,album_id,note,duration FROM songs WHERE song_id = :id") ; 
            $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
            $requete->execute() ; 
            $song = $requete->fetch(PDO::FETCH_ASSOC) ; 
            return $song ; 
        }

        public static function GetSongByAlbumId($id){
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("SELECT songs.song_id AS song_id, songs.title As title,songs.album_id AS album_id ,songs.note AS note,songs.duration AS duration FROM songs INNER JOIN albums ON songs.album_id = albums.album_id WHERE songs.album_id = :id") ; 
            $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
            $requete->execute() ; 
            $song = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
            return $song ; 
        }

        public static function create($title, $note,$duration, $album_id  ){
            try{
                $connexion = connexionBdd() ; 
                $requete = $connexion->prepare("INSERT INTO `songs`(song_id, title, note, duration,album_id,created_at,updated_at) VALUES(Null, :title, :note, :duration, :album, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
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
                $requete = $connexion->prepare("UPDATE `songs` SET title=:title , note=:note, duration=:duration,album_id=:album,updated_at=CURRENT_TIMESTAMP  WHERE song_id=:id") ; 
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
                $requete = $connexion->prepare("DELETE FROM `songs` WHERE `song_id` = :id"); 
                $requete->bindParam(':id',$id,PDO::PARAM_INT); 
                $requete->execute() ; 
            }catch(PDOException $e){
                echo "Erreur de suppression".$e ; 
            }
        }
        
    }