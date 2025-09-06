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
                        $message = "Mot de passe incorrect. Veuillez réessayer";
                    }
                }else{
                    $message = "Email incorrect. Veuillez réessayer";
                }
            }
        }catch(PDOException $e){
            echo "erreur de connexion".$e ; 
        }
        require_once('views/user/connexion.php') ; 
    }

    function signin(){
        try{
            if(isset($_POST['inscription'])){
                $email = $_POST['email'];
                $login = $_POST['login'];
                $password = $_POST['password'];
                
                $existingUser = User::getByEmail($email);
                if($existingUser){
                    $mailToken = "L'adresse email est déjà utilisé" ; 
                }else{
                    $pattern = '/^(?!.*' . preg_quote($login, '/') . ')(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}$/';

                    if (preg_match($pattern, $password)) {
                        echo "Mot de passe valide";
                        $user = User::create($login, $email, $password);
                    } else {
                        echo "Le mot de passe ne respecte pas la politique de sécurité";
                        $user = false; 
                    }
                    if($user){
                        $message = 'Inscription réussi';
                    }else{
                        $message = "Erreur lors de l'inscription";
                    }
                }
            }
            require_once('views/user/inscription.php') ; 
        }catch(PDOException $e){
            echo "erreur de connexion".$e ; 
        }
    }
