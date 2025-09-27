<?php
/**
 * Classe enfant des médias albums 
 * Attributs en plus : 
 * @param string name pour le nom de l'illustration
 * @param string $link pour le lien de l'image en ligne 
 * Méthodes SQL pour intéragir avec la table illustration de la bdd
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
            $requete = $connexion->prepare("SELECT illustration_id ,name,link FROM illustration") ; 
            $requete->execute() ; 
            $illustrations = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
            return $illustrations ; 
        }

        public static function getIllustrationById($id){
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("SELECT illustration_id, name,link FROM illustration WHERE illustration_id = :id") ; 
            $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
            $requete->execute() ; 
            $illustration = $requete->fetch(PDO::FETCH_ASSOC) ; 
            return $illustration ; 
        }

        public static function GetMediaByIllustrationId($id){
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("SELECT book.book_id, movie.movie_id, album.album_id 
                FROM illustration 
                LEFT JOIN book ON illustration.illustration_id = book.illustration_id 
                LEFT JOIN movie ON illustration.illustration_id = movie.illustration_id 
                LEFT JOIN album ON illustration.illustration_id = album.illustration_id 
                WHERE illustration.illustration_id = :id") ; 
            $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
            $requete->execute() ; 
            $illustration = $requete->fetch(PDO::FETCH_ASSOC) ; 
            return $illustration ; 
        }

        public static function create($name, $link){
            try{
                $connexion = connexionBdd() ; 
                $requete = $connexion->prepare("INSERT INTO `illustration`(illustration_id, name, link, created_at,updated_at) VALUES(Null, :name, :link, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
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
                $requete = $connexion->prepare("UPDATE `illustration` SET `name`=:name, `link`=:link,`updated_at`=CURRENT_TIMESTAMP WHERE illustration_id = :id;") ; 
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
                $requete = $connexion->prepare("DELETE FROM `illustration` WHERE `illustration_id` = :id"); 
                $requete->bindParam(':id',$id,PDO::PARAM_INT); 
                $requete->execute() ; 
            }catch(PDOException $e){
                echo "Erreur de suppression".$e ; 
            }
        }
    }