<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mon profil</title>
        <?php
        if(isset($_SESSION["user"])){
        $infosSession = $_SESSION["user"];
        }
        ?>
<p>Pseudo : <?= $infosSession["pseudo"] ?></p>
<p>Email : <?= $infosSession["email"] ?></p>

    </head>
    <body>

    <h1>S'inscrire</h1>