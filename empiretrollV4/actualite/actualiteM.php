<!--modele-->

<?php

//pour aller chercher une actualite en particulier
//dans le but de l'afficher
function get_actualite($id_actualite){
    global $bdd;
    //requete
    $req = $bdd->query(
        'SELECT a.id AS id_actualite, titre, DATE_FORMAT(date_creation, \'Le %d/%m/%Y à %Hh%imin%ss\') AS date, contenu, i.nom AS image
        FROM actualites AS a
        INNER JOIN images AS i
        ON a.id_image = i.id
        WHERE a.id = ' . $id_actualite);
    
    //entree de l'actualite dans un tableau
    $actualite = $req->fetch();
    $req->closeCursor();
    
    return $actualite;
}

//pour aller chercher les commentaires relatifs a une actualite
function get_commentaires($id_actualite){
    global $bdd;
    //requete
    $req = $bdd->query(
        'SELECT id, DATE_FORMAT(date_creation, \'Le %d/%m/%Y à %Hh%imin%ss\') AS date, contenu
        FROM actualites_commentaires
        WHERE id_actualite = ' . $id_actualite . '
        ORDER BY date DESC');
    
    //entree des commentaires dans un tableau
    $commentaires = $req->fetchAll();
    $req->closeCursor();
    
    return $commentaires;
}

?>