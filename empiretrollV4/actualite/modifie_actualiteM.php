<!--modele-->

<?php

//pour aller chercher une actualite en particulier
//dans le but de la modifier
function get_actualite($id_actualite){
    global $bdd;
    //requete
    $req = $bdd->query(
        'SELECT a.id AS id_actualite, date_creation, titre, contenu, i.nom AS image, supprimable AS image_supprimable, i.id AS id_image
        FROM actualites AS a
        INNER JOIN images AS i
        ON a.id_image =i.id
        WHERE a.id = ' . $id_actualite);
    
    //entree de l'actualite dans un tableau
    $actualite = $req->fetch();
    $req->closeCursor();
    
    return $actualite;
}

//pour aller chercher les images par defaut
function get_images_defaut(){
    global $bdd;
    //requete
    $req = $bdd->query('SELECT id, nom
        FROM images
        WHERE supprimable = 0');
    
    //entree des donnees dans un tableau
    $images_defaut = $req->fetchAll();
    $req->closeCursor();
    
    return $images_defaut;
}

?>