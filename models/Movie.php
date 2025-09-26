<?php

    enum Genre: string {
    case Action = 'Action';
    case Aventure = 'Aventure';
    case Comedie = 'Comédie';
    case Drame = 'Drame';
    case Horreur = 'Horreur';
    case Thriller = 'Thriller';
    case Fantastique = 'Fantastique';
    case ScienceFiction = 'ScienceFiction';
    case Fantasy = 'Fantasy';
    case Policier = 'Policier';
    case Romance = 'Romance';
    case Guerre = 'Guerre';
    case Western = 'Western';
    case Animation = 'Animation';
    case Documentaire = 'Documentaire';
    case Biopic = 'Biopic';
    case Historique = 'Historique';
}

    class Movie extends Media{

        private float $duration; 
        private Genre $genre; 

        public function __construct($titre, $auteur, $disponible,$duration, $genre){
            $this->duration = $duration; 
            $this->genre = Genre::from($genre); 
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
        $requete = $connexion->prepare("SELECT movie_id, title,author,disponibility,duration,genre,illustration.link FROM movie INNER JOIN illustration ON movie.illustration_id = illustration.illustration_id") ; 
        $requete->execute() ; 
        $movies = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
        return $movies ; 
    }

    public static function GetMovieById($id){
        $connexion = connexionBdd() ; 
        $requete = $connexion->prepare("SELECT movie_id, title,author,disponibility,duration,genre FROM movie WHERE movie_id = :id") ; 
        $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
        $requete->execute() ; 
        $movie = $requete->fetch(PDO::FETCH_ASSOC) ; 
        return $movie ; 
    }

    public static function create($titre, $auteur, $disponible,$duration, $genre, $illustration_id){
        try{
            $enumGenre = Genre::from($genre); 
            $valueGenre = $enumGenre->value;
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("INSERT INTO `movie`(`movie_id`, `title`,`author`,`disponibility`,`duration`,`genre`,`illustration_id`,`created_at`,`updated_at`)  VALUES(Null, :title, :author, :disponibility, :duration , :genre,:illustration_id, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
            $requete->bindParam(':title', $titre, PDO::PARAM_STR) ; 
            $requete->bindParam(':author', $auteur, PDO::PARAM_STR) ; 
            $requete->bindParam(':disponibility', $disponible, PDO::PARAM_INT) ; 
            $requete->bindParam(':duration', $duration, PDO::PARAM_INT) ; 
            $requete->bindParam(':genre', $valueGenre, PDO::PARAM_STR) ; 
            $requete->bindParam(':illustration_id', $illustration_id, PDO::PARAM_INT) ; 
            $requete->execute() ; 
        }catch(PDOException $e){
            echo "erreur de create ".$e ; 
        }
    }

    public static function update($id, $titre, $auteur, $disponible,$duration, $genre, $illustration_id){
        try{
            $enumGenre = Genre::from($genre); 
            $valueGenre = $enumGenre->value;
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("UPDATE `movie` SET `title`=:title, `author`=:author, `disponibility`=:disponibility, `duration`=:duration, `genre`=:genre, `illustration_id`=:illustration_id , `updated_at`=CURRENT_TIMESTAMP WHERE `movie_id`=:id") ; 
            $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
            $requete->bindParam(':title', $titre, PDO::PARAM_STR) ; 
            $requete->bindParam(':author', $auteur, PDO::PARAM_STR) ; 
            $requete->bindParam(':disponibility', $disponible, PDO::PARAM_INT) ; 
            $requete->bindParam(':duration', $duration, PDO::PARAM_INT) ; 
            $requete->bindParam(':genre', $valueGenre, PDO::PARAM_STR) ;  
            $requete->bindParam(':illustration_id', $illustration_id, PDO::PARAM_INT) ; 
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

    public static function rendre($id){
        try{
            $connexion = connexionBdd(); 
            $requete = $connexion->prepare("UPDATE `movie` SET `disponibility` = 1 WHERE `movie_id` = :id"); 
            $requete->bindParam(':id',$id,PDO::PARAM_INT); 
            $requete->execute() ;

        }catch(PDOException $e){
            echo "Erreur de suppression".$e ; 
        }
    }

    public static function emprunter($id){
        try{
            $connexion = connexionBdd(); 
            $requete = $connexion->prepare("UPDATE `movie` SET `disponibility` = 0 WHERE `movie_id` = :id"); 
            $requete->bindParam(':id',$id,PDO::PARAM_INT); 
            $requete->execute() ;

        }catch(PDOException $e){
            echo "Erreur de suppression".$e ; 
        }
    }

    public static function GetMovieByOrder($order){
        try{
            $connexion = connexionBdd(); 
            switch($order):
                case 'ASC' : 
                     $requete = $connexion->prepare("SELECT movie_id, title,author,disponibility,duration,genre,illustration.link FROM movie INNER JOIN illustration ON movie.illustration_id = illustration.illustration_id ORDER BY title ASC"); 
                     break; 
                case 'DESC': 
                    $requete = $connexion->prepare("SELECT movie_id, title,author,disponibility,duration,genre,illustration.link FROM movie INNER JOIN illustration ON movie.illustration_id = illustration.illustration_id ORDER BY title DESC"); 
                     break; 
                default : 
                 $requete = $connexion->prepare("SELECT movie_id, title,author,disponibility,duration,genre,illustration.link FROM movie INNER JOIN illustration ON movie.illustration_id = illustration.illustration_id"); 

            endswitch;

            $requete->execute() ;
            
            $movies = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
            return $movies ; 
        }catch(PDOException $e){
            echo "Erreur de suppression".$e ; 
        }
    }


    }