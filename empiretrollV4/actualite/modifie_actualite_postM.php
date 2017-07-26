<?php

//pour associer une actualite et une image dans la bdd
function lien_actualite_image($id_actualite, $id_image){
    global $bdd;
    //requete d'ajout
    $req = $bdd->prepare(
        'UPDATE 
        actualites 
        SET id_image = :id_image 
        WHERE id = :id');
    $req->execute(array(
        'id_image' => $id_image, 
        'id' => $id_actualite));
    $req->closeCursor();
                
}

//pour ajouter une image dans la bdd
function ajoute_image($nom_image){
    global $bdd;
    //requete d'ajout
    $req = $bdd->prepare(
        'INSERT INTO 
        images(nom, supprimable) 
        VALUES(:nom, 1)');
    $req->execute(array(
        'nom' =>  $nom_image));
    $req->closeCursor();
    
    //recuperation de l'id de l'image
    $id_image = $bdd->lastInsertId('id');
    
    return $id_image;
}

//pour modifier une actualite
function modifie_actualite($id, $titre, $contenu){
    global $bdd;
    
    //requete de modification
    $req = $bdd->prepare(
        'UPDATE 
        actualites 
        SET titre = :titre, contenu = :contenu 
        WHERE id=:id');
    $req->execute(array(
        'titre' => $titre, 
        'contenu' => $contenu, 
        'id' => $id));
    $req->closeCursor();
}

//Pour effectuer plein de verifications
function tout_correct(){
    if(isset($_FILES['image_chargee']) AND $_FILES['image_chargee']['error'] == 0){//verification de l'absence d'erreurs
        echo 'OK image chargée<br/>';
        if($_FILES['image_chargee']['size'] <= 1000000){//verification de la taille
            echo 'OK taille image<br/>';
            $extension = pathinfo($_FILES['image_chargee']['name'])['extension'];
            if(in_array($extension, array('jpg', 'jpeg', 'gif', 'png'))){//verification de l'extension
                echo 'Ok extension<br/>';
                return true;
            }
        }
    }
    return false;
}

//pour supprimer les images
function suppr_image($id_actualite){
    global $bdd;
    global $chemin_images;
    
    $req = $bdd->prepare(
        'SELECT i.id AS id_image, nom, supprimable
        FROM images i
        INNER JOIN actualites a
        ON i.id = a.id_image
        WHERE a.id = :id_actualite');
    $req->execute(array(
        'id_actualite' => $id_actualite));
    $image_associee = $req->fetch();
    $req->closeCursor();
    
    if($image_associee['supprimable'] == 1){
        //destruction des images
        unlink($chemin_images . $image_associee['nom']);
        unlink($chemin_images . 'miniature_' . $image_associee['nom']);

        //suppression de l'entree de la table
        $req = $bdd->prepare(
            'DELETE 
            FROM images 
            WHERE id=:id');
        $req->execute(array(
            'id' => $image_associee['id_image']));
        $req->closeCursor();
    }
}

//pour donner les bonnes dimensions à l'image et sa miniature
function resize_image($chemin_images, $nom_source, $nom_destination, $extension, $hauteur){
    //ouverture de l'image source en fonction de son extension
    if($extension == 'jpg' OR $extension == 'jpeg'){
        $source = imagecreatefromjpeg($chemin_images . $nom_source);
    }
    if($extension == 'png'){
        $source = imagecreatefrompng($chemin_images . $nom_source);
    }
    if($extension == 'gif'){
        $source = imagecreatefromgif($chemin_images . $nom_source);
    }
    
    //calcul des dimensions de l'image
    $largeur_source = imagesx($source);
    $hauteur_source = imagesy($source);
    $hauteur_destination = $hauteur;
    $largeur_destination = (int) $largeur_source * $hauteur_destination / $hauteur_source;
    
    //creation de l'image
    $destination = imagecreatetruecolor($largeur_destination, $hauteur_destination);
    imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
    
    //enregistrement de l'image selon l'extension de la source
    if($extension == 'jpg' OR $extension == 'jpeg'){
        imagejpeg($destination, $chemin_images . $nom_destination);
    }
    if($extension == 'png'){
        imagepng($destination, $chemin_images . $nom_destination);
    }
    if($extension == 'gif'){
        imagegif($destination, $chemin_images . $nom_destination);
    }
}

//pour enregistrer image et miniature a partir de celle fournie
function enregistre_image($image_chargee, $id_actualite, $chemin_images){
    //definition de variables utiles
    $extension = pathinfo($image_chargee['name'])['extension'];
    $nom_image = $id_actualite . '_image.' . $extension;
    $nom_temporaire = 'tmp_' . $nom_image;
    $nom_miniature = 'miniature_' . $nom_image;
    
    //enregistrement de l'image temporaire
    move_uploaded_file($image_chargee['tmp_name'], $chemin_images . $nom_temporaire);
    
    //redimensionnement de l'image
    resize_image($chemin_images, $nom_temporaire, $nom_image, $extension, 360);
    //enregistrement d'une miniature
    resize_image($chemin_images, $nom_temporaire, $nom_miniature, $extension, 50);
    //suppression de l'image temporaire
    unlink($chemin_images . $nom_temporaire);
    
    return $nom_image;
}

?>