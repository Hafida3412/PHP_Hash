<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content=" width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
       // var_dump($_SESSION);//Tableau user avec toutes les infos des users 

       if(isset($_SESSION["user"])){ //Je vérifie si je suis connecté
        ?>
       <a href="traitement.php?action=logout">Se déconnecter</a>
       <a href="traitement.php?action=profile">Mon profil</a>
       <?php } else { ?>
        <a href="traitement.php?action=login">Se connecter</a>
        <a href="traitement.php?action=register">S'inscrire</a>
       <?php }   ?>

        <h1>ACCUEIL</h1>

        <?php 
       if(isset($_SESSION["user"])){//Lorsque l'utilisateur se connecte, on affiche un message de bienvenu personnalisé
        echo "<p>Bienvenue". $_SESSION["user"]["pseudo"]."</p>";// On accède au pseudo de l'utilisateur connecté
       } 
        
        ?>
</html>