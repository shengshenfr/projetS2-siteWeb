<!--modele-->

<?php

//pour aller chercher les images par defaut
function get_images_defaut(){
    global $bdd;
    //requete
    $req = $bdd->query(
        'SELECT id, nom
        FROM images
        WHERE supprimable = 0');
    //entree des donnees dans un tableau
    $images_defaut = $req->fetchAll();
    $req->closeCursor();
    
    return $images_defaut;
}

//pour ajouter une actualite dans la bdd
function ajoute_actualite($titre, $contenu){
    global $bdd;
    //requete d'ajout
    $req = $bdd->prepare(
        'INSERT INTO 
        actualites(titre, date_creation, contenu, id_image) 
        VALUES(:titre, NOW(), :contenu, 0)');
    $req->execute(array(
        'titre' => $titre,
        'contenu' => $contenu));
    $req->closeCursor();
    
    //recuperation de l'id de l'actualite
    $id_actualite = $bdd->lastInsertId('id');
    
    return $id_actualite;
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

//Pour effectuer plein de verifications
function tout_correct(){
    if(isset($_FILES['image_chargee']) AND $_FILES['image_chargee']['error'] == 0){//verification de l'absence d'erreurs
        if($_FILES['image_chargee']['size'] <= 1000000){//verification de la taille
            $extension = pathinfo($_FILES['image_chargee']['name'])['extension'];
            if(in_array($extension, array('jpg', 'jpeg', 'gif', 'png'))){//verification de l'extension
                return true;
            }
        }
    }
    return false;
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