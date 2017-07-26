<!--controleur-->

<?php
/*
//gestion de la session
include_once('gestion_session.php');
//connexion a la base de donnees
include_once('connexion_bdd.php');*/
//insertion du modele
include_once('actualite/modifie_actualiteM.php');

//traitement des infos

//booleen de page valide
$valide = false;
//chemin vers les images depuis la vue
/*$chemin_images = 'images/';*/

if(isset($_GET['id_actualite'])){//si les donnees ont bien ete transmises par l'URL
    //recherche de l'actualite
    $_GET['id_actualite'] = (int) $_GET['id_actualite'];
    $actualite = get_actualite($_GET['id_actualite']);
    
    if(!empty($actualite)){//si l'actualite a ete trouvee
        //formatage des chaines de caracteres
        $actualite['titre'] = htmlspecialchars($actualite['titre']);
        $actualite['contenu'] = htmlspecialchars($actualite['contenu']);
        $actualite['image'] = htmlspecialchars($actualite['image']);
        
        //recherche des images par defaut
        $images_defaut = get_images_defaut();

        foreach($images_defaut as $cle => $elt){
            //formatage des chaines de caracteres
            $images_default[$cle]['nom'] = htmlspecialchars($elt['nom']);
        }
        
        //appel de la vue
        include_once('pages/modifie_actualiteV.php');
        $valide = true;
    }
}
if(!$valide){//si la page n'est pas valide
    //retour au fil d'actualites
    header('Location: index.php?id_page=100');
}
?>