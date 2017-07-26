<!--controleur-->

<?php
/*
//gestion de la session
include_once('../actualite/gestion_session.php');*/

//traitement des infos

if($estMembre){//si l'utilisateur est déjà connecté
    //retour à l'accueil
    header('Location: ../index.php');
}
else{//si l'utilisateur n'est pas connecté
    //appel de la vue
    include_once('pages/inscriptionV.php');
}
?>