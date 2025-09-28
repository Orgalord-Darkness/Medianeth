<?php
    /**
     * Classe Illustration
     *
     * Représente une illustration liée aux médias (livres, films, albums).
     *
     * Attributs :
     * @property string $name Nom de l'illustration
     * @property string $link URL du lien vers l'image en ligne
     *
     * Constructeur :
     * @param string $name Nom de l'illustration
     * @param string $link Lien vers l'image
     *
     * Méthodes SQL :
     * @method static array GetIllustration() Récupère toutes les illustrations
     * @method static array|null GetIllustrationById(int $id) Récupère une illustration par son ID
     * @method static array|null GetMediaByIllustrationId(int $id) Récupère les médias associés à une illustration
     * @method static int|null GetIllustrationIdByName(string $name) Récupère l'ID d'une illustration par son nom (insensible à la casse)
     * @method static void create(string $name, string $link) Crée une nouvelle illustration
     * @method static void update(int $id, string $name, string $link) Met à jour une illustration existante
     * @method static void delete(int $id) Supprime une illustration par son ID
     */

    class Illustration{

        private string $name; 
        private string $link; 

        public function __construct($name, $link){
            $this->name = $name; 
            $this->link = $link; 
        }

        public function getName(){
            return $this->name; 
        }

        public function setName(string $name){
            $this->name = $name; 
        }

        public function getLink(){
            return $this->link; 
        }

        public function setLink(string $link){
            $this->link = $link; 
        }

        public static function GetIllustration(){ 
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("SELECT illustration_id ,name,link FROM illustrations") ; 
            $requete->execute() ; 
            $illustrations = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
            return $illustrations ; 
        }

        public static function GetIllustrationById($id){
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("SELECT illustration_id, name,link FROM illustrations WHERE illustration_id = :id") ; 
            $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
            $requete->execute() ; 
            $illustration = $requete->fetch(PDO::FETCH_ASSOC) ; 
            return $illustration ; 
        }

        public static function GetMediaByIllustrationId($id){
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("SELECT books.book_id, movies.movie_id, albums.album_id , users.user_id
                FROM illustrations 
                LEFT JOIN books ON illustrations.illustration_id = books.illustration_id 
                LEFT JOIN movies ON illustrations.illustration_id = movies.illustration_id 
                LEFT JOIN albums ON illustrations.illustration_id = albums.illustration_id 
                LEFT JOIN users ON illustrations.illustration_id = users.illustration_id 
                WHERE illustrations.illustration_id = :id") ; 
            $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
            $requete->execute() ; 
            $illustration = $requete->fetch(PDO::FETCH_ASSOC) ; 
            return $illustration ; 
        }

        public static function GetIllustrationIdByName($name){
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("SELECT illustration_id FROM illustrations WHERE LOWER(name) LIKE LOWER(:name)") ; 
            $requete->bindParam(':name', $name, PDO::PARAM_STR) ; 
            $requete->execute() ; 
            $illustration_data = $requete->fetch(PDO::FETCH_ASSOC) ; 
            if ($illustration_data && isset($illustration_data['illustration_id'])) {
                return (int) $illustration_data['illustration_id'];
            }
        }

        public static function create($name, $link){
            try{
                $connexion = connexionBdd() ; 
                $requete = $connexion->prepare("INSERT INTO `illustrations`(illustration_id, name, link, created_at,updated_at) VALUES(Null, :name, :link, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
                $requete->bindParam(':name', $name, PDO::PARAM_STR) ; 
                $requete->bindParam(':link', $link, PDO::PARAM_STR) ;
                $requete->execute() ; 
            }catch(PDOException $e){
                echo "erreur de create ".$e ; 
            }
        }

        public static function update($id, $name, $link){
            try{
                $connexion = connexionBdd() ; 
                $requete = $connexion->prepare("UPDATE `illustrations` SET `name`=:name, `link`=:link,`updated_at`=CURRENT_TIMESTAMP WHERE illustration_id = :id;") ; 
                $requete->bindParam(':id', $id, PDO::PARAM_INT); 
                $requete->bindParam(':name', $name, PDO::PARAM_STR) ; 
                $requete->bindParam(':link', $link, PDO::PARAM_STR) ;
                $requete->execute(); 
            }catch(PDOException $e){
                echo "erreur de modification ".$e ; 
            }
        }

        public static function delete($id){ 
            try{
                $connexion = connexionBdd() ; 
                $requete = $connexion->prepare("DELETE FROM `illustrations` WHERE `illustration_id` = :id"); 
                $requete->bindParam(':id',$id,PDO::PARAM_INT); 
                $requete->execute() ; 
            }catch(PDOException $e){
                echo "Erreur de suppression".$e ; 
            }
        }
    }