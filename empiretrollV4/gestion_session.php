<?php
//demarrage de la session
session_start();

//droits par defaut si non definis
if(!isset($_SESSION['estMembre'])){
    $_SESSION['estMembre'] = false;
}
if(!isset($_SESSION['estAdmin'])){
    $_SESSION['estAdmin'] = false;
}
if(!isset($_SESSION['pseudoMembre'])){
    $_SESSION['pseudoMembre'] = "Personne";
}
if(!isset($_SESSION['idMembre'])){
    $_SESSION['idMembre'] = 0;
}

$estMembre = $_SESSION['estMembre'];
$estAdmin = $_SESSION['estAdmin'];
$pseudoMembre = $_SESSION['pseudoMembre'];
$idMembre = $_SESSION['idMembre'];
?>