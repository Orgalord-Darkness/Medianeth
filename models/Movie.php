<?php

    enum Genre{
        case Action ; 

        case Aventure ; 

        case Comédie ; 

        case Drame ; 

        case Horreur ; 

        case Thriller ; 

        case Fantastique ;

        case ScienceFiction ; 

        case Fantasy ; 

        case Policier ; 

        case Romance ; 

        case Guerre ; 

        case Western ; 

        case Animation ; 

        case Documentaire ; 

        case Biopic ; 

        case Historique ; 
    }
    class Movie extends Media{

        private float $duration; 
        private Genre $genre; 

        public function __construct($titre, $auteur, $disponible,$duration, $genre){
            $this->duration = $duration; 
            $this->genre = $genre; 
            parent::__construct($titre, $auteur, $disponible);
        }

        public function getDuration(){
            return $this->duration; 
        }

        public function setDuration(float $duration){
            $this->duration = $duration; 
        }

        public function getGenre(){
            return $this->genre; 
        }

        public function setGenre(Genre $genre){
            $this->genre = $genre; 
        }

        public static function GetMovie(){ 
        $connexion = connexionBdd() ; 
        $requete = $connexion->prepare("SELECT titre,auteur,disponible,duration,genre FROM movie") ; 
        $requete->execute() ; 
        $movies = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
        return $movies ; 
    }

    public static function GetMovieById($id){
        $connexion = connexionBdd() ; 
        $requete = $connexion->prepare("SELECT titre,auteur,disponible,duration,genre FROM movie WHERE movie_id = :id") ; 
        $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
        $requete->execute() ; 
        $movies = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
        return $movies ; 
    }

    public static function create($titre, $auteur, $disponible,$duration, $genre){
        try{
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("INSERT INTO `movie` VALUES(Null, :title, :author, :disponibility, :duration , :genre,CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
            $requete->bindParam(':title', $titre, PDO::PARAM_STR) ; 
            $requete->bindParam(':author', $auteur, PDO::PARAM_STR) ; 
            $requete->bindParam(':disponible', $disponible, PDO::PARAM_BOOL) ; 
            $requete->bindParam(':duration', $duration, PDO::PARAM_INT) ; 
            $requete->bindParam(':genre', $genre, PDO::PARAM_STR) ; 
            $requete->execute() ; 
        }catch(PDOException $e){
            echo "erreur de create ".$e ; 
        }
    }

    public static function update($titre, $auteur, $disponible,$duration, $genre){
        try{
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("UPDATE `movie` `titre`=:title, `auteur`=:author, `disponible`=:disponibility, `duree`=:duration, `genre`=:genre, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
            $requete->bindParam(':title', $titre, PDO::PARAM_STR) ; 
            $requete->bindParam(':author', $auteur, PDO::PARAM_STR) ; 
            $requete->bindParam(':disponible', $disponible, PDO::PARAM_BOOL) ; 
            $requete->bindParam(':duration', $duration, PDO::PARAM_INT) ; 
            $requete->bindParam(':genre', $genre, PDO::PARAM_STR) ;  
            $requete->execute() ; 
        }catch(PDOException $e){
            echo "erreur de modification ".$e ; 
        }
    }

    public static function delete($id){ 
        try{
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("DELETE FROM `movie` WHERE `movie_id` = :id"); 
            $requete->bindParam(':id',$id,PDO::PARAM_INT); 
            $requete->execute() ; 
        }catch(PDOException $e){
            echo "Erreur de suppression".$e ; 
        }
    }


    }