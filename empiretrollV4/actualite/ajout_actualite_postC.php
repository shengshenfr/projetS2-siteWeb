<!--controleur-->
<!--enregistrement des donnees du formulaire-->
<!--
champs : titre, contenu, image, image_chargee(file)
-->

<?php

//gestion de la session
include_once('../gestion_session.php');
//connexion a la base de donnees
include_once('../connexion_bdd.php');
//insertion du modele
include_once('ajout_actualite_postM.php');

//chemin vers le fichier images
$chemin_images = 'images/';

if($estAdmin){//si l'utilisateur a les droits
    echo 'OK administrateur<br/>';
    print_r($_POST);
    if(isset($_POST['titre']) AND isset($_POST['contenu']) AND isset($_POST['image'])){//si les donnees ont bien ete transmises par le formulaire
        echo 'OK donnees formulaire<br/>';
        //formatage des chaines de caracteres
        $_POST['titre'] = htmlspecialchars($_POST['titre']);
        $_POST['contenu'] = htmlspecialchars($_POST['contenu']);
        $_POST['image'] = htmlspecialchars($_POST['image']);
        
        //requete d'ajout
        $id_actualite = ajoute_actualite($_POST['titre'], $_POST['contenu']);
        
        if($_POST['image'] == "nouvelle image"){//si l'utilisateur a choisi d'importer une image
            echo 'OK nouvelle image<br/>';
            if(tout_correct()){//verification que tout est correct
                echo 'OK tout correct<br/>';
                
                //enregistrement de la nouvelle image
                $nom_image = enregistre_image($_FILES['image_chargee'], $id_actualite, $chemin_images);
                echo 'OK image resize<br/>';
                
                //ajout de l'image dans la base de donnees
                $id_image = ajoute_image($nom_image);
                echo 'OK image dans bdd<br/>';
                
                //modification de l'actualite
                lien_actualite_image($id_actualite, $id_image);
                echo 'OK actualite modifiee<br/>';
            }
            else{
                //attribution d'une image par defaut
                $_POST['image'] = get_images_defaut()[0]['id'];
                echo 'OK changement d\'image<br/>';
            }
        }
        if(!isset($id_image)){
            //modification de l'actualite
            $_POST['image'] = (int) $_POST['image'];
            lien_actualite_image($id_actualite, $_POST['image']);
        }
    }
}


if(isset($id_actualite)){
    //on va voir l'actualite fraichement creee
    header('Location: ../index.php?id_page=101&id_actualite=' . $id_actualite);
}
else{
    //retour au fil d'actualites
    header('Location: ../index.php?id_page=100');
}

?>
<a href="index.php?id_page=100.php">Retour</a>
<!--       
-->