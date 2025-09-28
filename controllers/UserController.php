<?php 
    function login(){
        try{
            if(isset($_POST['connexion'])){
                $email = $_POST['email'];
                $password = $_POST['password'];
                $user = User::GetUserByEmail($email);
                if($user){
                    if( password_verify($password, $user['password'])){
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['login'] = $user['login'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['illustration']= $user['link'];
                        header('Location:/Medianeth/Home/library');
                        exit();
                    }else{
                        $message = "<p class='text-danger'>Mot de passe incorrect. Veuillez réessayer</p>";
                    }
                }else{
                    $message = "<p class='text-danger'>Email incorrect. Veuillez réessayer</p>";
                }
            }
        }catch(PDOException $e){
            echo "erreur de connexion".$e ; 
        }
        require_once('views/user/connexion.php') ; 
    }

    function logout(){
        $_SESSION = [];
        session_destroy();
        header('Location:/Medianeth/User/login');
        exit();
    }

    function signin(){
        try{
            $illustrations = Illustration::GetIllustration();
            if(isset($_POST['inscription'])){
                if(isset($_POST['email']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['name'])&& isset($_POST['link']) ){
                    $email = $_POST['email'];
                    $login = $_POST['login'];
                    $password = $_POST['password'];
                    $name_illustration = $_POST['name'];
                    $link_illustration = $_POST['link'];
                    if(!empty($email) && !empty($login) && !empty($password) && !empty($name_illustration) && !empty($link_illustration)){
                        $existingUser = User::GetUserByEmail($email);
                        if($existingUser){
                            $mailToken = "L'adresse email est déjà utilisé" ; 
                            $message="<p class='text-danger'>l'email est déjà utilisé</p>";
                        }else{
                            $pattern = '/^(?!.*' . preg_quote($login, '/') . ')(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}$/';

                            if (preg_match($pattern, $password)) {
                                $illustration = Illustration::create($name_illustration, $link_illustration);
                                $illustration_id = Illustration::GetIllustrationIdByName($name_illustration);
                                $user = User::create($login, $email, $password,$illustration_id);
                                $message = "<p class='text-success'>Inscription réussi</p>";
                            } else {
                                $message = "<p class='text-danger'>Le mot de passe doit avoir 8 caractères minimum, des caractères spéciaux et ne pas contenir le login</p>"; 
                                $user = false; 
                            }
                        }
                    }else{
                        $message = "<p class='text-danger'>Remplir tous les champs</p>"; 
                    }
                }
            }
            require_once('views/user/inscription.php') ; 
        }catch(PDOException $e){
            echo "erreur de connexion".$e ; 
        }
    }


    function delete() {
        if (isset($_POST['user_id'])) {
            $id = $_POST['user_id'];

            $user = User::GetUserById($id);

            if (!empty($user)) {
                if (isset($_POST['ask']) && $_POST['ask'] === 'Supprimer') {
                    User::delete($id);
                    return logout();
                }
            } else {
                $message = "Suppression annulée : utilisateur non trouvé.";
            }
        } else {
            $message = "Suppression annulée.";
        }

        require_once('views/user/delete.php');
    }
