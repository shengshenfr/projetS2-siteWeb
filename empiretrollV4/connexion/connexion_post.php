<!--connexion-->
<!--
champs : pseudo, mdp
-->

<?php

//connexion a la base de donnees
include_once('../connexion_bdd.php');
//fonction connexion
include_once('../connexion/connexionM.php');

session_start();

//traitement des infos

if(isset($_POST['pseudo']) AND isset($_POST['mdp'])){//si les donnees ont bien ete transmises par le formulaire
    //formatage des chaines de caracteres
    $_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
 	$_POST['mdp'] = htmlspecialchars($_POST['mdp']);

    //Récupère les information sur le membre ayant ce pseudo
    $membre=get_membre($_POST['pseudo']);

    if($membre==0){ //Si le membre n'existe pas
    	header('Location: ../index.php?id_page=300&erreur=1');

    } elseif(($membre['mdp']==$_POST['mdp']) AND ($membre['admin']!=1) AND ($membre['actif']==1)){ //Si le membre est un utilisateur
		$_SESSION['estMembre'] = true;
		$_SESSION['estAdmin'] = false;
        $_SESSION['pseudoMembre'] = $membre['pseudo'];
        $_SESSION['idMembre'] = $membre['id'];
        header('Location: ../index.php');

    } elseif(($membre['mdp']==$_POST['mdp']) AND ($membre['admin']==1) AND ($membre['actif']==1)){ //si le membre est un administrateur
		$_SESSION['estMembre'] = true;
		$_SESSION['estAdmin'] = true;
        $_SESSION['pseudoMembre'] = $membre['pseudo'];
        $_SESSION['idMembre'] = $membre['id'];

        header('Location: ../index.php');

	} else { //Si le membre existe mais que le mot de passe est faux ou que le compte n'est pas actif
        header('Location: ../index.php?id_page=300&erreur=2.php');
    }
}

?>