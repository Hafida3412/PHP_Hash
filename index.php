<?php

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

//-> if(password_verify($saisie, $hash)){
//   echo "Les MDP correspondent!";}
//   else {
//   echo "Les MDP ne correspondent pas!";}

