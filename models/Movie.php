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
   /**
     * Classe Movie
     *
     * Représente un média de type film. Hérite de la classe Media.
     * Gère les opérations liées aux films dans la base de données.
     *
     * Attributs :
     * @property float $duration Durée du film en heures.
     * @property Genre $genre Genre du film (énumération personnalisée).
     *
     * Constructeur :
     * @param string $titre Titre du film
     * @param string $auteur Auteur ou réalisateur du film
     * @param int $disponible Disponibilité (1 = disponible, 0 = non)
     * @param float $duration Durée du film
     * @param string $genre Genre du film (valeur de l'enum Genre)
     *
     * Méthodes :
     * @method float getDuration() Retourne la durée du film
     * @method void setDuration(float $duration) Définit la durée du film
     * @method Genre getGenre() Retourne le genre du film
     * @method void setGenre(Genre $genre) Définit le genre du film
     *
     * Méthodes SQL :
     * @method static array GetMovie() Récupère tous les films avec leurs illustrations
     * @method static array|null GetMovieById(int $id) Récupère un film par son ID
     * @method static void create(string $titre, string $auteur, int $disponible, float $duration, string $genre, int $illustration_id) Crée un film en base
     * @method static void update(int $id, string $titre, string $auteur, int $disponible, float $duration, string $genre, int $illustration_id) Met à jour un film
     * @method static void delete(int $id) Supprime un film par son ID
     * @method static void rendre(int $id) Marque le film comme disponible
     * @method static void emprunter(int $id) Marque le film comme emprunté
     * @method static array GetMovieByOrder(string $order) Récupère les films triés par titre (ASC ou DESC)
     */

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
        $requete = $connexion->prepare("SELECT movie_id, title,author,disponibility,duration,genre,illustrations.link FROM movies INNER JOIN illustrations ON movies.illustration_id = illustrations.illustration_id") ; 
        $requete->execute() ; 
        $movies = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
        return $movies ; 
    }

    public static function GetMovieById($id){
        $connexion = connexionBdd() ; 
        $requete = $connexion->prepare("SELECT movie_id, title,author,disponibility,duration,genre FROM movies WHERE movie_id = :id") ; 
        $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
        $requete->execute() ; 
        $movie = $requete->fetch(PDO::FETCH_ASSOC) ; 
        return $movie ; 
    }

    public static function GetMovieBySearch($title, $author, $dispo, $n1, $n2, $genre){ 
        try{
            $connexion = connexionBdd() ; 
            $sql = "SELECT movie_id, title,author,disponibility,duration,genre,illustrations.link FROM movies INNER JOIN illustrations ON movies.illustration_id = illustrations.illustration_id";
            $requete = $connexion->prepare($sql); 
           if (!empty($title)) {
                $sql .= " AND title LIKE :title";
            }
            if (!empty($author)) {
                $sql .= " AND author LIKE :author";
            }
            if (!empty($dispo)) {
                $sql .= " AND disponibility = :dispo";
            }
            if (!empty($n1) && !empty($n2)) {
                $sql .= " AND duration BETWEEN :n1 AND :n2";
            }
            if (!empty($genre)) {
                $sql .= " AND genre LIKE :genre";
            }

            $requete = $connexion->prepare($sql);

            if (!empty($title)) {
                $requete->bindValue(':title', "%$title%", PDO::PARAM_STR); 
            }
            if (!empty($author)) {
                $requete->bindValue(':author', "%$author%", PDO::PARAM_STR);
            }
            if (!empty($dispo)) {
                $requete->bindValue(':dispo', $dispo, PDO::PARAM_INT);
            }
            if (!empty($n1) && !empty($n2)) {
                $requete->bindValue(':n1', $n1, PDO::PARAM_INT);
                $requete->bindValue(':n2', $n2, PDO::PARAM_INT);
            }
            if (!empty($genre)) {
                $requete->bindValue(':genre', "%$genre%", PDO::PARAM_STR);
            }


            $requete->execute() ; 
            $movies = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
            return $movies ; 
        }catch(PDOException $e){
            echo "Erreur de suppression".$e ; 
        }
    }


    public static function create($titre, $auteur, $disponible,$duration, $genre, $illustration_id){
        try{
            $enumGenre = Genre::from($genre); 
            $valueGenre = $enumGenre->value;
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("INSERT INTO `movies`(`movie_id`, `title`,`author`,`disponibility`,`duration`,`genre`,`illustration_id`,`created_at`,`updated_at`)  VALUES(Null, :title, :author, :disponibility, :duration , :genre,:illustration_id, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
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
            $requete = $connexion->prepare("UPDATE `movies` SET `title`=:title, `author`=:author, `disponibility`=:disponibility, `duration`=:duration, `genre`=:genre, `illustration_id`=:illustration_id , `updated_at`=CURRENT_TIMESTAMP WHERE `movie_id`=:id") ; 
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
            $requete = $connexion->prepare("DELETE FROM `movies` WHERE `movie_id` = :id"); 
            $requete->bindParam(':id',$id,PDO::PARAM_INT); 
            $requete->execute() ; 
        }catch(PDOException $e){
            echo "Erreur de suppression".$e ; 
        }
    }

    public static function rendre($id){
        try{
            $connexion = connexionBdd(); 
            $requete = $connexion->prepare("UPDATE `movies` SET `disponibility` = 1 WHERE `movie_id` = :id"); 
            $requete->bindParam(':id',$id,PDO::PARAM_INT); 
            $requete->execute() ;

        }catch(PDOException $e){
            echo "Erreur de suppression".$e ; 
        }
    }

    public static function emprunter($id){
        try{
            $connexion = connexionBdd(); 
            $requete = $connexion->prepare("UPDATE `movies` SET `disponibility` = 0 WHERE `movie_id` = :id"); 
            $requete->bindParam(':id',$id,PDO::PARAM_INT); 
            $requete->execute() ;

        }catch(PDOException $e){
            echo "Erreur de suppression".$e ; 
        }
    }

    public static function GetMovieByDispo($dispo){
        try{
            $connexion = connexionBdd(); 
            switch($dispo):
                case 'true' : 
                     $requete = $connexion->prepare("SELECT movie_id, title,author,disponibility,duration,genre,illustrations.link FROM movies INNER JOIN illustrations ON movies.illustration_id = illustrations.illustration_id WHERE disponibility = 1"); 
                     break; 
                case 'false': 
                    $requete = $connexion->prepare("SELECT movie_id, title,author,disponibility,duration,genre,illustrations.link FROM movies INNER JOIN illustrations ON movies.illustration_id = illustrations.illustration_id WHERE disponibility = 0"); 
                     break; 
                default : 
                 $requete = $connexion->prepare("SELECT movie_id, title,author,disponibility,duration,genre,illustrations.link FROM movies INNER JOIN illustrations ON movies.illustration_id = illustrations.illustration_id"); 

            endswitch;

            $requete->execute() ;
            
            $movies = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
            return $movies ; 
        }catch(PDOException $e){
            echo "Erreur de suppression".$e ; 
        }
    }


    }