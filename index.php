<?php
session_start();

$password = "monMotdePasse1234";
$password2 = "monMotdePasse1234";
$password3 = "monMotdePasse1234";
$password4 = "monMotdePasse1234";


//ALGORITHMES DE HASHAGE FAIBLE//
$md5 = hash('md5', $password);    //-> le hashage est identique pour un même MDP, et ne
$md5_2 = hash('md5', $password);  // change pas lorsqu'on rafraîchit la page
//echo $md5 . "<br>";
//echo $md5_2 . "<br>";
//echo "<br>";

$sha256 = hash('sha256', $password); //le hashage est plus llon que l'exemple précédent
$sha256_2 = hash('sha256', $password);// le résultat est aussi identique pour les 2 MDP
//echo $sha256 . "<br>";
//echo $sha256_2 . "<br>";
//echo "<br>";

//ALGORITHMES DE HASHAGE FORTS//
//-> BCRYPT
$hash = password_hash($password, PASSWORD_DEFAULT);//DEFAULT EST LE + PERFORMANT ET UTILISE LA DERNIERE VERSION DE HASHAGE EN COURS
$hash2 = password_hash($password2, PASSWORD_DEFAULT);
//echo $hash. "<br>";
//echo $hash2. "<br>";
//echo "<br>";
//le résultat affiché est UNE EMPREINTE NUMERIQUE, ici c'est composé de: l'algo($2y$), du coût/cost(10$), du salt() et du hashage()
//le hashage est long et change à chaque refresh de la page
//le résultat des 2 mêmes MDP sont différents


//-> ARGON2I
$hash3 = password_hash($password3, PASSWORD_ARGON2I);
$hash4 = password_hash($password4, PASSWORD_ARGON2I);
//echo $hash3. "<br>";
//echo $hash4. "<br>";
//le résultat affiché est composé de: l'algo($argon2i$), du coût/cost(v=19$m=65536,t=4,p=1$), du salt() et du hashage()
//le hashage est plus long et change à chaque refresh de la page
//le résultat des 2 mêmes MDP sont différents


//Saisie dans le formulaire de login
$saisie = "monMotdePasse1234";

$check = password_verify($saisie, $hash);//password_verify vérifie qu'un MDP correspond à un hachage
//Il sert à comparer un MDP saisi ds un formulaire avec le hash géneré dans la BDD (result: true or false)
$user = "Mickael";

 if(password_verify($saisie, $hash)){
   //echo "Les MDP correspondent!";
$_SESSION [ "user"] = $user;
echo $user. "est connecté.";
   echo "Les MDP sont différents!";
}

//POINTS ESSENTIELS A CONTROLER LORS DE LA MISE EN PLACE DES METHODES register() ET login()
//(IDEALEMENT DANS SecurityController):
/*

Pour le register:
 - on filtre les champs du formulaire
 - si les filtres sont valides on vérifie que le mail n'existe pas déjà (sinon message d'erreur)
 - on vérifie que le pseudo n'existe pas non plus(sinon message d'erreur)
 - on vérifie que les 2 MDP de formulaire soient identiques
 - si c'est le cas, on hash le MDP(password_hash)
 - on ajoute l'utilisateur en base de données

 Pour le login:
 - on filtre les champs du formulaire
 - si les filtres passent, on retrouve le password correspondant au mail entré dans le formulaire
 - si on le trouve, on récupère le hash de la base de données
 - on retrouve l'utilisateur correspondant
 - on vérifie le MDP(password_verify)
 - si on arrive à se connecter, on fait passer le user en session
 - si aucune des conditions ne passent(mauvais MDP, utilisateur inexistant, etc): message d'erreur

 Consulter la documentation sur les 2 méthodes PHP natives et de bien comprendre leur utilité/utilisation:
 - password_hash
 - password_verify
 
*/
 
