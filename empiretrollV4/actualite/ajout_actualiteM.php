<!--Modele-->

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

?>