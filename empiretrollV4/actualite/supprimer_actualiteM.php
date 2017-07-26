<?php

//pour supprimer les images
function suppr_image($id_actualite){
    global $bdd;
    global $chemin_images;
    
    //requete pour les infos sur l'image
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
    
    if($image_associee['supprimable'] == 1){//si l'image est supprimable
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

//pour supprimer une actualite
function suppr_actualite($id_actualite){
    global $bdd;
    
    //requete de suppression
    $req = $bdd->prepare(
        'DELETE 
        FROM actualites 
        WHERE id=:id');
    $req->execute(array(
        'id' => $id_actualite));
    $req->closeCursor();
}

?>