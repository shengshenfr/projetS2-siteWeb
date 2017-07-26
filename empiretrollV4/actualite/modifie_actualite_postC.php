<!--enregistrement des donnees du formulaire-->
<!--
champs : id_actualite, titre, contenu, image, image_chargee(files), id_image
-->

<?php

//gestion de la session
include_once('../gestion_session.php');
//connexion a la base de donnees
include_once('../connexion_bdd.php');
//insertion du modele
include_once('modifie_actualite_postM.php');

//chemin ders le dossier images
$chemin_images = 'images/';

if($estAdmin){//si l'utilisateur a les droits
    if(isset($_POST['titre']) AND isset($_POST['contenu']) AND isset($_POST['id_actualite']) AND isset($_POST['image'])){//si les donnees ont bien ete transmises par le formulaire
        //formatage des chaines de caracteres
        $_POST['titre'] = htmlspecialchars($_POST['titre']);
        $_POST['contenu'] = htmlspecialchars($_POST['contenu']);
        $_POST['image'] = htmlspecialchars($_POST['image']);
        $_POST['id_image'] = (int) $_POST['id_image'];
        $_POST['id_actualite'] = (int) $_POST['id_actualite'];
        
        //requete de modification
        modifie_actualite($_POST['id_actualite'], $_POST['titre'], $_POST['contenu']);
        
        if($_POST['image'] == "nouvelle image"){//si l'utilisateur a choisi d'importer une image
            echo 'OK nouvelle image<br/>';
            if(tout_correct()){//verification que tout est correct
                echo 'OK tout correct<br/>';
                //suppression potentielle des images
                suppr_image($_POST['id_actualite']);
                
                //enregistrement de la nouvelle image
                $nom_image = enregistre_image($_FILES['image_chargee'], $_POST['id_actualite'], $chemin_images);
                echo 'OK image enregistree<br/>';
                
                //ajout de l'image dans la base de donnees
                $id_image = ajoute_image($nom_image);
                echo 'OK image dans bdd<br/>';
                
                //modification de l'actualite
                lien_actualite_image($_POST['id_actualite'], $id_image);
                echo 'OK actualite modifiee<br/>';
            }
        }
        else{
            $_POST['image'] = (int) $_POST['image'];
            
            if($_POST['image'] != $_POST['id_image']){//si l'image choisie est differente de la precedente
                //suppression potentielle des images
                suppr_image($_POST['id_actualite']);
                
                //modification de l'actualite
                lien_actualite_image($_POST['id_actualite'], $_POST['image']);
                echo 'OK actualite modifiee<br/>';
            }
        }
    }
}

if(isset($_POST['id_actualite'])){//si on connait l'actualite concernee
    //on s'y rend
    header('Location: ../index.php?id_page=101&id_actualite=' . $_POST['id_actualite']);
}
else{
    //retour au fil d'actualites
    header('Location: ../index.php?id_page=100');
}
?>

<a href="../index.php?id_page=100">Retour</a>