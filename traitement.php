<?php

if (isset($_GET["action"])){  //SI LE FORMUAIRE EST SOUMIS:
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
                if($user){
                    header("Location: register.php"); exit; 
                } else {
                    //var dump("utilisateur inexistant");die;
                    //insertion de l'utilisateur en BDD
                if($pass1 = $pass2 && strlen($pass1) >= 5) {//VERIFICATION QUE LES MDP SONT IDENTIQUES
                    $insertUser = $pdo->prepare("INSERT INTO user (pseudo, email, password) VALUES (:pseudo, :email, :password)");
                    $insertUser->execute([
                        "pseudo" => $pseudo,
                        "email" => $email,
                        "password" => password_hash($pass1, PASSWORD_DEFAULT)// MDP HASHE
                    ]);
                    header("Location: login.php"); exit;
                } else {
                    //message "Les MDP ne sont pas identiques ou MDP trop court!
                }
            }
            } else {
                //problème de saisie dans les champs de formulaire
            }
    
        // SI LE FORMULAIRE N EST PAS SOUMIS J AFFICHE LE FORMULAIRE D INSCRIPTION
                    header("Location: register.php"); exit;
                
        break;

        case "login":
            //connexion à l'application
        if($_POST["submit"]){
            //CONNEXION A LA BASE DE DONNEES:
            $pdo = new PDO("mysql: host=localhost; dbname=php_hash_colmar;charset=utf8", "root", "");
           
            //PROTECTION XSS (=FILTRES)
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
            if($email && $password) {//REQUETE PREPARE POUR LUTTER CTRE LES INJECTIONS SQL
                $requete = $pdo->prepare("SELECT * FROM user WHERE email = :email");
                $requete->execute(["email" => $email]);
                $user = $requete->fetch();

                //var_dump($user);die;
            }
        
        }
        header("Location: login.php"); exit;
        break;
        
        case "logout":
        break;
}
}