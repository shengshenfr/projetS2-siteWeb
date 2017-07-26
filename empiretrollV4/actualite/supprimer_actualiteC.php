<!--enregistrement des donnees du formulaire-->
<!--
champs : id, titre, contenu
-->

<?php

//gestion de la session
include_once('../gestion_session.php');
//connexion a la base de donnees
include_once('../connexion_bdd.php');
//insertion du modele
include_once('supprimer_actualiteM.php');

//chemin jusqu'aux images
$chemin_images = 'images/';

if($estAdmin){//si l'utilisateur a les droits
    if(isset($_GET['id_actualite'])){//si les donnees ont bien ete transmises par l'URL
        //suppression potentielle de l'image
        suppr_image($_GET['id_actualite']);

        //suppression de l'actualite
        suppr_actualite($_GET['id_actualite']);
    }
}

//retour au fil d'actualites
header('Location: ../index.php?id_page=100');

?>
<!--<a href="fil_actualitesC.php">Retour</a>-->