<?php 
    /**
     * Classe User pour les utilisateurs de l'application.
     *
     * Attributs :
     * @property string $login Identifiant de l'utilisateur
     * @property string $email Adresse email de l'utilisateur
     * @property string $password Mot de passe hashé stocké dans la base de données
     * @property Illustration $illustration Illustration / avatar du compte utilisateur
     *
     * Méthodes principales :
     * - get/set pour chaque attribut
     * - Méthodes statiques pour interagir avec la base de données :
     *   - GetUser() : récupère tous les utilisateurs
     *   - GetUserByEmail(string $email) : récupère un utilisateur via son email
     *   - GetUserById(int $id) : récupère un utilisateur via son ID
     *   - create(string $login, string $email, string $password, int $illustration_id) : crée un nouvel utilisateur
     *   - delete(int $id) : supprime un utilisateur par ID
     */
    class User {
        
        private string $login; 
        private string $email;
        private string $password;
        private Illustration $illustration;

        public function __construct($login, $email, $password, Illustration $illustration){
            $this->login = $login; 
            $this->email = $email; 
            $this->password = $password; 
            $this->illustration = $illustration;
        }

        public function getIllustration(): Illustration {
            return $this->illustration;
        }

        public function setIllustration(Illustration $illustration): void {
            $this->illustration = $illustration;
        }

        public function getLogin(){
            return $this->login; 
        }

        public function setLogin($login){
            $this->login = $login; 
        }

        public function getEmail(){
            return $this->email; 
        }

        public function setEmail($email){
            $this->email = $email; 
        }

        public function getPassword(){
            return $this->password; 
        }

        public function setPassword($password){
            $this->password = $password; 
        }

        public static function GetUser(){ 
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("SELECT user_id, login, email, password, illustration_id FROM users") ; 
            $requete->execute() ; 
            $users = $requete->fetchAll(PDO::FETCH_ASSOC) ; 
            return $users ; 
        }

        public static function GetUserByEmail($email){
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("SELECT user_id, login,email, password, illustrations.link AS link FROM users INNER JOIN illustrations ON users.illustration_id = illustrations.illustration_id WHERE email = :email") ; 
            $requete->bindParam(':email', $email, PDO::PARAM_STR) ; 
            $requete->execute() ; 
            $user = $requete->fetch(PDO::FETCH_ASSOC) ; 
            return $user ; 
        }

        public static function GetUserById($id){
            $connexion = connexionBdd() ; 
            $requete = $connexion->prepare("SELECT user_id, login,email, password, illustrations.link AS link FROM users INNER JOIN illustrations ON users.illustration_id = illustrations.illustration_id WHERE user_id = :id") ; 
            $requete->bindParam(':id', $id, PDO::PARAM_INT) ; 
            $requete->execute() ; 
            $user = $requete->fetch(PDO::FETCH_ASSOC) ; 
            return $user ; 
        }

        public static function create($login, $email, $password, $illustration_id){
            try{
                $connexion = connexionBdd() ; 
                $hash = password_hash($password, PASSWORD_ARGON2ID);
                $requete = $connexion->prepare("INSERT INTO `users`(user_id, login, email, password, illustration_id, created_at, updated_at) VALUES(NULL, :login, :email, :password, :illustration_id, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)"); 
                $requete->bindParam(':login', $login, PDO::PARAM_STR) ; 
                $requete->bindParam(':email', $email, PDO::PARAM_STR);
                $requete->bindParam(':password', $hash, PDO::PARAM_STR) ; 
                $requete->bindParam(':illustration_id', $illustration_id, PDO::PARAM_INT);
                $requete->execute() ; 

            }catch(PDOException $e){
                echo "erreur de create ".$e ; 
            }
        }

        public static function delete($id) {
            try {
                $connexion = connexionBdd();
                $requete = $connexion->prepare("DELETE FROM `users` WHERE user_id = :id");
                $requete->bindParam(':id', $id, PDO::PARAM_INT);
                $requete->execute();
            } catch (PDOException $e) {
                echo "Erreur de suppression : " . $e->getMessage();
            }
        }
    }
