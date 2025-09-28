<?php
    /**
     * Classe Album représentant un média de type album, héritant de la classe Media.
     *
     * Attributs :
     * @property int $songNumber Nombre de pistes dans l'album
     * @property string $editor Éditeur de l'album
     * @property Illustration $illustration Illustration associée à l'album
     *
     * Méthodes principales :
     * - get/set pour chaque attribut
     * - Méthodes statiques pour interagir avec la base de données :
     *   - GetAlbum() : récupère tous les albums avec leurs illustrations
     *   - GetAlbumByOrder(string $order) : récupère les albums triés par titre (ASC ou DESC)
     *   - getAlbumById(int $id) : récupère un album spécifique via son ID
     *   - create(string $titre, string $auteur, int $disponible, int $songNumber, string $editor, int $illustration_id) : crée un nouvel album
     *   - update(int $id, string $titre, string $auteur, int $disponible, int $songNumber, string $editor, int $illustration_id) : met à jour un album existant
     *   - delete(int $id) : supprime un album via son ID
     *   - rendre(int $id) : marque l'album comme disponible (disponibility = 1)
     *   - emprunter(int $id) : marque l'album comme emprunté (disponibility = 0)
     */
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
            $requete = $connexion->prepare("SELECT album_id,title,author,disponibility,songNumber,editor, link FROM albums INNER JOIN illustrations ON albums.illustration_id = illustrations.illustration_id") ; 
            $requete->execute() ; 
            $albums = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
            return $albums ; 
        }

        public static function GetAlbumByDispo($dispo){ 
            try{
                $connexion = connexionBdd(); 
                switch($dispo):
                    case "true" : 
                        $requete = $connexion->prepare("SELECT album_id,title,author,disponibility,songNumber,editor, link FROM albums INNER JOIN illustrations ON albums.illustration_id = illustrations.illustration_id WHERE disponibility = 1"); 
                        break; 
                    case "false": 
                        $requete = $connexion->prepare("SELECT album_id,title,author,disponibility,songNumber,editor, link FROM albums INNER JOIN illustrations ON albums.illustration_id = illustrations.illustration_id WHERE disponibility = 0"); 
                        break; 
                    default : 
                        $requete = $connexion->prepare("SELECT album_id,title,author,disponibility,songNumber,editor, link FROM albums INNER JOIN illustrations ON albums.illustration_id = illustrations.illustration_id"); 

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
            $requete = $connexion->prepare("SELECT album_id, title,author,disponibility,songNumber,editor, albums.illustration_id, link FROM albums INNER JOIN illustrations ON albums.illustration_id = illustrations.illustration_id WHERE album_id = :id") ; 
            $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
            $requete->execute() ; 
            $album = $requete->fetch(PDO::FETCH_ASSOC) ; 
            return $album ; 
        }

        public static function GetAlbumBySearch($title, $author, $dispo, $n1, $n2, $editor){ 
            try{
                $connexion = connexionBdd() ; 
                $sql = "SELECT album_id,title,author,disponibility,songNumber,editor, link FROM albums INNER JOIN illustrations ON albums.illustration_id = illustrations.illustration_id";
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
                    $sql .= " AND songNumber BETWEEN :n1 AND :n2";
                }
                if (!empty($editor)) {
                    $sql .= " AND editor LIKE :editor";
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
                if (!empty($editor)) {
                    $requete->bindValue(':editor', "%$editor%", PDO::PARAM_STR);
                }
                $requete->execute() ; 
                $albums = $requete->fetchAll(PDO::FETCH_ASSOC);
                return $albums ; 
            }catch(PDOException $e){
                echo "Erreur de suppression".$e ; 
            }
        }

        public static function create($titre, $auteur, $disponible,$songNumber, $editor,$illustration_id){
            try{
                $connexion = connexionBdd() ; 
                $requete = $connexion->prepare("INSERT INTO `albums`(album_id, title, author, disponibility,songNumber,editor,illustration_id, created_at,updated_at) VALUES(Null, :title, :author, :disponibility, :songNumber, :editor,:illustration_id, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
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
                $requete = $connexion->prepare("UPDATE `albums` SET `title`=:title, `author`=:author, `disponibility`=:disponibility, `songNumber`=:songNumber,`editor`=:editor, `illustration_id`= :illustration_id,`updated_at`=CURRENT_TIMESTAMP WHERE album_id = :id;") ; 
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
                $requete = $connexion->prepare("DELETE FROM `albums` WHERE `album_id` = :id"); 
                $requete->bindParam(':id',$id,PDO::PARAM_INT); 
                $requete->execute() ; 
            }catch(PDOException $e){
                echo "Erreur de suppression".$e ; 
            }
        }

        public static function rendre($id){
            try{
                $connexion = connexionBdd(); 
                $requete = $connexion->prepare("UPDATE `albums` SET `disponibility` = 1 WHERE `album_id` = :id"); 
                $requete->bindParam(':id',$id,PDO::PARAM_INT); 
                $requete->execute() ;

            }catch(PDOException $e){
                echo "Erreur de suppression".$e ; 
            }
        }

        public static function emprunter($id){
            try{
                $connexion = connexionBdd(); 
                $requete = $connexion->prepare("UPDATE `albums` SET `disponibility` = 0 WHERE `album_id` = :id"); 
                $requete->bindParam(':id',$id,PDO::PARAM_INT); 
                $requete->execute() ;

            }catch(PDOException $e){
                echo "Erreur de suppression".$e ; 
            }
        }


    }