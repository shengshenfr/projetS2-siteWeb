<!--modele-->

<?php

//pour aller chercher le membre qui a le pseudo
function get_membre($pseudo){
    global $bdd;
    //requete
    $req = $bdd->query('
    SELECT id, pseudo, mdp, admin, actif
    FROM membres
    WHERE pseudo="'.$pseudo.'"');
    
    if(!$req){ //si le pseudo n'existe pas
        $membre = 0;
    } else { //entree des donnees dans un tableau
        $membre = $req->fetch();
        $req->closeCursor();
    }
    
    return $membre;
}

?>