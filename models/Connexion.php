<?php 

    function connexionBdd(){
        $server = "localhost" ;
        $login = "root" ; 
        $password = "" ; 
        $db = "mediatheque" ; 

        try{
            $connexion = new PDO("mysql:host=$server;dbname=$db",$login,$password);
            return $connexion ;         
        }catch(PDOException $e){
            die("échec de la connexion". $e->getMessage()) ; 
        }
    }
    