<?php 
    function login(){
        try{
            if(isset($_POST['connexion'])){
                $email = $_POST['email'];
                $password = $_POST['password'];
                $user = User::getByEmail($email);
                if($user){
                    if( password_verify($password, $user['password'])){
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['login'] = $user['login'];
                        $_SESSION['email'] = $user['email'];
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
            if(isset($_POST['inscription'])){
                if(isset($_POST['email']) && isset($_POST['login']) && isset($_POST['password'])){
                    $email = $_POST['email'];
                    $login = $_POST['login'];
                    $password = $_POST['password'];
                    if(!empty($email) && !empty($login) && !empty($password)){
                        $existingUser = User::getByEmail($email);
                        if($existingUser){
                            $mailToken = "L'adresse email est déjà utilisé" ; 
                            $message="<p class='text-danger'>l'email est déjà utilisé</p>";
                        }else{
                            $pattern = '/^(?!.*' . preg_quote($login, '/') . ')(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}$/';

                            if (preg_match($pattern, $password)) {
                                $user = User::create($login, $email, $password);
                            } else {
                                $message = "<p class='text-danger'>Le mot de passe doit avoir 8 caractères minimum, des caractères spéciaux et ne pas contenir le login</p>"; 
                                $user = false; 
                            }
                            if($user){
                                $message = "<p class='text-success'>Inscription réussi</p>";
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
