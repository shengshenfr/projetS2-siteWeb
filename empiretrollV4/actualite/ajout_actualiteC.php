<!--controleur-->

<?php
/*
//gestion de la session
include_once('gestion_session.php');
//connexion a la base de donnees
include_once('connexion_bdd.php');*/
//insertion du modele
include_once('actualite/ajout_actualiteM.php');

//traitement des infos

//chemin vers les images depuis la vue
/*$chemin_images = 'images/';*/

if($estAdmin){//si l'utilisateur a les droits
    //recherche des images par defaut
    $images_defaut = get_images_defaut();
    
    foreach($images_defaut as $cle => $elt){
        //formatage des chaines de caracteres
        $images_default[$cle]['nom'] = htmlspecialchars($elt['nom']);
    }
    
    //appel de la vue
    include_once('pages/ajout_actualiteV.php');
}
else{//si l'utilisateur n'a pas les droits
    //retour sur le fil d'actualites
    header('Location: index.php?id_page=100');
}
?>