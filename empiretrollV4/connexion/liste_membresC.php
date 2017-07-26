<!--controleur-->

<?php
/*
//gestion de la session
include_once('../actualite/gestion_session.php');
//connexion a la base de donnees
include_once('../actualite/connexion_bdd.php');*/
//insertion du modele
include_once('connexion/liste_membresM.php');

//traitement des infos

//Si l'utilisateur est un administrateur
if($estAdmin){
	//recherche de la liste des membres
	$liste_membres = get_liste_membres();

	foreach($liste_membres as $cle => $elt){
    	//formatage des chaines de caracteres
    	$liste_membres[$cle]['pseudo']= htmlspecialchars($elt['pseudo']);
    	$liste_membres[$cle]['mail']= htmlspecialchars($elt['mail']);
	}

	//appel de la vue
	include_once('pages/liste_membresV.php');

} else {
	//Si l'utilisateur n'est pas un administrateur retour à l'index
	header('Location: index.php');
}
?>