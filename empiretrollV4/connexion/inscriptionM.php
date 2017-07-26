<!--Modele-->

<?php
//pour voir si l'information existe déjà dans la base de donnée
function existe($information){
    global $bdd;
    //requete
    $req = $bdd->query('
    SELECT COUNT(DISTINCT pseudo)
    FROM membres
    WHERE pseudo="'.$information.'"');
    
    if(!$req){ //si le pseudo n'existe pas
        $resultat = false;
    } else { //entree des donnees dans un tableau
        $resultat = true;
    }
    
    return $resultat;
}
?>