<!--connexion-->
<!--
champs : admin, activer, desactiver, desamin
-->

<?php

//gestion de la session
include_once('../gestion_session.php');
//connexion a la base de donnees
include_once('../connexion_bdd.php');
//insertion du modele
include_once('../connexion/liste_membresM.php');

if($estAdmin){//si l'utilisateur a les droits
    if($_POST['activer']){
        //Activer un compte
    	activer($_POST['membreid'], 1);
    }
    if($_POST['admin']){
        //Render un utilisateur administrateur
    	rendre_admin($_POST['membreid'], 1);
    }
    if($_POST['desactiver']){
        //Désactiver un compte
    	activer($_POST['membreid'], 0);
    }
    if($_POST['desadmin']){
        //Déchoir un administrateur de son statut
    	rendre_admin($_POST['membreid'], 0);
    }
}

//retour au tableau des membres
header('Location: ../index.php?id_page=302');
?>