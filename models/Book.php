<?php 
    /**
     * Classe Book
     *
     * Représente un média de type livre, héritant de la classe Media.
     * Contient des informations spécifiques aux livres, comme le nombre de pages.
     *
     * Attributs :
     * @property int $pageNumber Nombre de pages du livre
     *
     * Constructeur :
     * @param string $titre         Titre du livre
     * @param string $auteur        Auteur du livre
     * @param int    $disponible    Disponibilité (1 = disponible, 0 = non)
     * @param int    $pageNumber    Nombre de pages
     *
     * Méthodes :
     * @method int getPageNumber() Retourne le nombre de pages
     * @method void setPageNumber(int $pageNumber) Définit le nombre de pages
     * @method void read() Méthode vide (placeholder éventuel)
     *
     * Méthodes SQL :
     * @method static array GetBook() Récupère tous les livres avec illustrations
     * @method static array|null GetBookById(int $id) Récupère un livre par ID
     * @method static array GetBookByOrder(string $order) Récupère les livres triés par titre (ASC ou DESC)
     * @method static void create(string $titre, string $auteur, int $disponible, int $pageNumber, int $illustration_id) Crée un livre
     * @method static void update(int $id, string $titre, string $auteur, int $disponible, int $pageNumber, int $illustration_id) Met à jour un livre
     * @method static void delete(int $id) Supprime un livre
     * @method static void rendre(int $id) Marque le livre comme disponible
     * @method static void emprunter(int $id) Marque le livre comme emprunté
     */
    class Book extends Media{
        
        private int $pageNumber; 

        public function __construct($titre, $auteur, $disponible,$pageNumber){
            $this->pageNumber = $pageNumber; 
            parent::__construct($titre, $auteur, $disponible);
        }

        public function getPageNumber(){
            return $this->pageNumber; 
        }

        public function setPageNumber($pageNumber){
            $this->pageNumber = $pageNumber; 
        }

        public function read(){
            $connexion = connexionBdd(); 

        }

        public static function GetBook(){ 
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("SELECT book_id, title,author,disponibility,pageNumber,illustrations.link FROM books INNER JOIN illustrations ON books.illustration_id = illustrations.illustration_id") ; 
            $requete->execute() ; 
            $books = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
            return $books ; 
        }

        public static function GetBookByDispo($dispo){ 
        try{
                $connexion = connexionBdd(); 
                switch($dispo):
                    case 'true' : 
                        $requete = $connexion->prepare("SELECT book_id, title,author,disponibility,pageNumber,illustrations.link FROM books INNER JOIN illustrations ON books.illustration_id = illustrations.illustration_id WHERE disponibility = 1"); 
                        break; 
                    case 'false': 
                        $requete = $connexion->prepare("SELECT book_id, title,author,disponibility,pageNumber,illustrations.link FROM books INNER JOIN illustrations ON books.illustration_id = illustrations.illustration_id WHERE disponibility = 0"); 
                        break; 
                    default : 
                    $requete = $connexion->prepare("SELECT book_id, title,author,disponibility,pageNumber,illustrations.link FROM books INNER JOIN illustrations ON books.illustration_id = illustrations.illustration_id"); 

                endswitch;
                $requete->execute() ;
                $books = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
                return $books ; 
            }catch(PDOException $e){
                echo "Erreur de suppression".$e ; 
            }
        }

        public static function GetBookById($id){
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("SELECT book_id, title,author,disponibility,pageNumber FROM books WHERE book_id = :id") ; 
            $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
            $requete->execute() ; 
            $book = $requete->fetch(PDO::FETCH_ASSOC) ; 
            return $book ; 
        }

        public static function create($titre, $auteur, $disponible,$pageNumber,$illustration_id){
            try{
                $connexion = connexionBdd() ; 
                $requete = $connexion->prepare("INSERT INTO `books`(book_id, title, author, disponibility,pageNumber,illustration_id,created_at,updated_at) VALUES(Null, :title, :author, :disponibility, :pageNumber, :illustration_id ,CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)") ; 
                $requete->bindParam(':title', $titre, PDO::PARAM_STR) ; 
                $requete->bindParam(':author', $auteur, PDO::PARAM_STR) ; 
                $requete->bindParam(':disponibility', $disponible, PDO::PARAM_INT) ; 
                $requete->bindParam(':pageNumber', $pageNumber, PDO::PARAM_INT) ; 
                $requete->bindParam(':illustration_id', $illustration_id, PDO::PARAM_INT) ; 
                $requete->execute() ; 
            }catch(PDOException $e){
                echo "erreur de create ".$e ; 
            }
        }

        public static function update($id, $titre, $auteur, $disponible,$pageNumber,$illustration_id){
            try{
                $connexion = connexionBdd() ; 
                $requete = $connexion->prepare("UPDATE `books` SET `title`=:title, `author`=:author, `disponibility`=:disponibility, `pageNumber`=:pageNumber, `updated_at`=CURRENT_TIMESTAMP, `illustration_id`=:illustration_id WHERE `book_id`=:id;") ; 
                $requete->bindParam(':id', $id, PDO::PARAM_INT) ;
                $requete->bindParam(':title', $titre, PDO::PARAM_STR) ; 
                $requete->bindParam(':author', $auteur, PDO::PARAM_STR) ; 
                $requete->bindParam(':disponibility', $disponible, PDO::PARAM_INT) ; 
                $requete->bindParam(':pageNumber', $pageNumber, PDO::PARAM_INT) ; 
                $requete->bindParam(':illustration_id', $illustration_id, PDO::PARAM_INT) ; 
                $requete->execute() ; 
            }catch(PDOException $e){
                echo "erreur de modification ".$e ; 
            }
        }

        public static function delete($id){ 
            try{
                $connexion = connexionBdd() ; 
                $requete = $connexion->prepare("DELETE FROM `books` WHERE `book_id` = :id"); 
                $requete->bindParam(':id',$id,PDO::PARAM_INT); 
                $requete->execute() ; 
            }catch(PDOException $e){
                echo "Erreur de suppression".$e ; 
            }
        }

        public static function rendre($id){
            try{
                $connexion = connexionBdd(); 
                $requete = $connexion->prepare("UPDATE `books` SET `disponibility` = 1 WHERE `book_id` = :id"); 
                $requete->bindParam(':id',$id,PDO::PARAM_INT); 
                $requete->execute() ;

            }catch(PDOException $e){
                echo "Erreur de suppression".$e ; 
            }
        }

        public static function emprunter($id){
            try{
                $connexion = connexionBdd(); 
                $requete = $connexion->prepare("UPDATE `books` SET `disponibility` = 0 WHERE `book_id` = :id"); 
                $requete->bindParam(':id',$id,PDO::PARAM_INT); 
                $requete->execute() ;

            }catch(PDOException $e){
                echo "Erreur de suppression".$e ; 
            }
        }
        
    }