<?php 
define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME'])); 
session_start();
include_once('models/Connexion.php'); 
include_once('models/Media.php');
include_once('models/Book.php'); 
include_once('models/Movie.php'); 
include_once('models/Album.php'); 
include_once('models/User.php');
include_once('views/menu.php') ; 

if(isset($_GET['action']) && !empty($_GET['action'])){
    $params = explode("/",$_GET['action']); 

    if($params[0] != ""){
        $controller = $params[0]; 
        $action = isset($params[1]) ? $params[1] : 'library'; 
        $controllerFile = ROOT.'controllers/'.$controller.'Controller.php'; 

        if(file_exists($controllerFile)){
            require_once($controllerFile); 

            if(function_exists($action)){
                if(isset($params[2]) && isset($params[3])){
                    $action($params[2], $params[3]);
                }elseif(isset($params[2])){
                    $action($params[2]); 
                }else{
                    $action(); 
                }
            }else{
                header('HTTP/1.0 404 Not Found'); 
                require_once('views/errors/404.html'); 
            }
        }else{
            header('HTTP/1.0 404 Not Found'); 
            require_once('views/errors/404.html'); 
        }
    }else{
        header('HTTP/1.0 404 Not Found'); 
        require_once('views/errors/404.html');
    }
}else{
    require_once('controllers/BookController.php'); 
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <link rel = "stylesheet" href = "/heure_dvt/assets/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href ="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
        <!-- <link rel="icon" href="favicon.ico" type ="ico"/> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Scripts de Bootstrap (optionnel : pour le JavaScript) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <!-- jQuery (nécessaire pour manipuler le DOM) -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
        <script src="/heure_dvt/assets/ajax.js"></script>
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM9Ul12AqdeRSC4GLRe+lA9zJXla43itcdvB5bD" crossorigin="anonymous"> -->
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <title>heure_dvt</title>
    </head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Inclusion du JS de Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Votre script de démarrage -->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var myModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            myModal.show();
        });
    </script>
</html>