<?php

if (isset($_GET["action"])){
    switch($_GET["action"]){
        case "register":
            //CONNEXION A LA BASE DE DONNEES:
             $pdo = new PDO("mysql: host=localhost; dbname=php_hash_colmar;charset=utf8", "root", "");
            
             //FILTRER LES CHAMPS DU FORMULAIRE D INSCRIPTION:
             $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
             $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
             //VERIFIER LA VALIDITE DES FILTRES:
             if($pseudo && $email && $pass1 && $pass2){
                //var dump("ok");die;
                //pour lutter contre les injections SQL: requête prepare
                $requete = $pdo->prepare("SELECT * FROM user WHERE email = :email");//requete préparée se fait par un champ paramétré préfixé par un dble point(:email)
                $requete->execute(["email" => $email]);
                $user = $requete->fetch();
                //SI L UTILISATEUR EXISTE
                if ($user){
                    header("Location: register.php"); exit; (18:09)
                }
            
            }

        break;
    }
}