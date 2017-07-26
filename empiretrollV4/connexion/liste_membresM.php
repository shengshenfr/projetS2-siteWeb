<!--modele-->

<?php

//pour aller chercher l'ensemble des membres
function get_liste_membres(){
    global $bdd;
    //requete
    $req = $bdd->query('
    SELECT id, pseudo, mail, actif, admin
    FROM membres');
    //entree des donnees dans un tableau
    $liste_membres = $req->fetchAll();
    $req->closeCursor();
    
    return $liste_membres;
}

function activer($id,$actif){
    //$id = id du membre dont on veut modifier le statut
    //$actif = 1 pour rendre actif, 0 pour désactiver
    global $bdd;
    $req = $bdd->prepare('UPDATE membres SET actif = :actif WHERE id=:id');
    $req->execute(array('id' => $id, 'actif' => $actif));
}

function rendre_admin($id,$admin){
    //$id = id du membre dont on veut modifier le statut
    //$admin = 1 pour rendre administrateur, 0 pour déchoir du statut d'administrateur
    global $bdd;
    $req = $bdd->prepare('UPDATE membres SET admin = :admin WHERE id=:id');
    $req->execute(array('id' => $id, 'admin' => $admin));
}
?>