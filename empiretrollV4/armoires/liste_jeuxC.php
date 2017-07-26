<!--controleur-->

<?php

include_once("liste_jeuxM.php");
include_once("ajouter_jeuM.php");
try
{
    
	//nombre de jeu par page
	$tab_nbapp = array(8, 16, 32, 64);

	//nombre total de jeu
	$nb_jeux = get_nb_jeux();

	//definition du nombre de jeu par page
	$nbapp = get_nbapp($tab_nbapp);

	//definition de la page actuelle
	$numpage = get_numpage($nb_jeux, $nbapp);

    $liste_jeux=get_liste_jeux2($numpage, $nbapp);

    foreach($liste_jeux as $jeu) {
    	$res_genre[$jeu['id_jeu']]=get_genre($jeu['id_jeu']);
    }

	include_once("empiretrollV4\pages\liste_jeuxV.php");
}

catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

?>