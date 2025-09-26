<?php
    class Album extends Media{

        private int $songNumber; 
        private string $editor ; 
        private Illustration $illustration; 

        public function __construct($titre, $auteur, $disponible,$songNumber, $editor,$illustration){
            $this->songNumber = $songNumber; 
            $this->editor = $editor; 
            $this->illustration = $illustration; 
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

        public function getIllustration(){
            return $this->illustration; 
        }

        public function setIllustration(string $illustration){
            $this->illustration = $illustration; 
        }

        public static function GetAlbum(){ 
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("SELECT album_id,title,author,disponibility,songNumber,editor, link FROM album INNER JOIN illustration ON album.illustration_id = illustration.illustration_id") ; 
            $requete->execute() ; 
            $albums = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
            return $albums ; 
        }

        public static function GetAlbumByOrder($order){ 
            try{
                $connexion = connexionBdd(); 
                switch($order):
                    case 'ASC' : 
                        $requete = $connexion->prepare("SELECT album_id,title,author,disponibility,songNumber,editor, link FROM album INNER JOIN illustration ON album.illustration_id = illustration.illustration_id ORDER BY title ASC"); 
                        break; 
                    case 'DESC': 
                        $requete = $connexion->prepare("SELECT album_id,title,author,disponibility,songNumber,editor, link FROM album INNER JOIN illustration ON album.illustration_id = illustration.illustration_id ORDER BY title DESC"); 
                        break; 
                    default : 
                        $requete = $connexion->prepare("SELECT album_id,title,author,disponibility,songNumber,editor, link FROM album INNER JOIN illustration ON album.illustration_id = illustration.illustration_id"); 

                endswitch;

                $requete->execute() ;
                
                $albums = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
                return $albums ; 
            }catch(PDOException $e){
                echo "Erreur de suppression".$e ; 
            }
        }

        public static function getAlbumById($id){
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("SELECT album_id, title,author,disponibility,songNumber,editor FROM album WHERE album_id = :id") ; 
            $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
            $requete->execute() ; 
            $album = $requete->fetch(PDO::FETCH_ASSOC) ; 
            return $album ; 
        }

        public static function create($titre, $auteur, $disponible,$songNumber, $editor,$illustration_id){
            try{
                $connexion = connexionBdd() ; 
                $requete = $connexion->prepare("INSERT INTO `album`(album_id, title, author, disponibility,songNumber,editor,illustration_id created_at,updated_at) VALUES(Null, :title, :author, :disponibility, :songNumber, :editor,:illustration_id, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
                $requete->bindParam(':title', $titre, PDO::PARAM_STR) ; 
                $requete->bindParam(':author', $auteur, PDO::PARAM_STR) ; 
                $requete->bindParam(':disponibility', $disponible, PDO::PARAM_INT) ; 
                $requete->bindParam(':songNumber', $songNumber, PDO::PARAM_INT) ;
                $requete->bindParam(':editor', $editor, PDO::PARAM_STR) ; 
                $requete->bindParam(':illustration_id', $illustration_id, PDO::PARAM_INT) ;
                $requete->execute() ; 
            }catch(PDOException $e){
                echo "erreur de create ".$e ; 
            }
        }

        public static function update($id, $titre, $auteur, $disponible,$songNumber, $editor,$illustration_id){
            try{
                $connexion = connexionBdd() ; 
                $requete = $connexion->prepare("UPDATE `album` SET `title`=:title, `author`=:author, `disponibility`=:disponibility, `songNumber`=:songNumber,`editor`=:editor, `illustration_id`= :illustration_id,`updated_at`=CURRENT_TIMESTAMP WHERE album_id = :id;") ; 
                $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
                $requete->bindParam(':title', $titre, PDO::PARAM_STR) ; 
                $requete->bindParam(':author', $auteur, PDO::PARAM_STR) ; 
                $requete->bindParam(':disponibility', $disponible, PDO::PARAM_INT) ; 
                $requete->bindParam(':songNumber', $songNumber, PDO::PARAM_INT) ;
                $requete->bindParam(':editor', $editor, PDO::PARAM_STR) ;
                $requete->bindParam(':illustration_id', $illustration_id, PDO::PARAM_INT) ; 
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

        public static function rendre($id){
            try{
                $connexion = connexionBdd(); 
                $requete = $connexion->prepare("UPDATE `album` SET `disponibility` = 1 WHERE `album_id` = :id"); 
                $requete->bindParam(':id',$id,PDO::PARAM_INT); 
                $requete->execute() ;

            }catch(PDOException $e){
                echo "Erreur de suppression".$e ; 
            }
        }

        public static function emprunter($id){
            try{
                $connexion = connexionBdd(); 
                $requete = $connexion->prepare("UPDATE `album` SET `disponibility` = 0 WHERE `album_id` = :id"); 
                $requete->bindParam(':id',$id,PDO::PARAM_INT); 
                $requete->execute() ;

            }catch(PDOException $e){
                echo "Erreur de suppression".$e ; 
            }
        }


    }