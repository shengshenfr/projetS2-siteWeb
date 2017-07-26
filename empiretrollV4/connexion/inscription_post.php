<!--enregistrement du nouvel inscrit-->
<!--
champs : pseudo, mdp, mail
-->

<?php

//gestion de la session
include_once('../gestion_session.php');
//connexion a la base de donnees
include_once('../connexion_bdd.php');
//fonction connexion
include_once('../connexion/inscriptionM.php');

if(isset($_POST['pseudo']) AND isset($_POST['mdp']) AND isset($_POST['mail'])){//si les donnees ont bien ete transmises par le formulaire
    //formatage des chaines de caracteres
	$_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
	$_POST['mdp'] = htmlspecialchars($_POST['mdp']);
	$_POST['mail'] = htmlspecialchars($_POST['mail']);
        
	if(existe($_POST['pseudo'])){
		header('Location: ../index.php?id_page=301&erreur=1');
	} else {
		//requete d'ajout
		$req = $bdd->prepare('INSERT INTO membres(pseudo, mdp, mail, actif, admin) VALUES(:pseudo, :mdp, :mail, 0, 0)');
		$req->execute(array('pseudo' => $_POST['pseudo'], 'mdp' => $_POST['mdp'], 'mail' => $_POST['mail']));
		//retour à l'index
		header('Location: ../index.php');
	}
	
} else {
	//retour à l'index
	header('Location: ../index.php');
}

?>