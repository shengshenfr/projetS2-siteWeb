<!--controleur-->

<!--Donnees du $_GET

'nbapp' : nombre d'actualites par page

'numpage' : numero de la page a afficher

'annee' : annee a afficher

'mois' : mois a afficher

-->

<?php
/*
//gestion de la session
include_once('gestion_session.php');
//connexion a la base de donnees
include_once('connexion_bdd.php');*/
//insertion du modele
include_once('actualite/fil_actualitesM.php');

//quelques constantes utiles

//chemin vers les images depuis la vue
/*$chemin_images = 'images/';*/
//nombre d'actualites par page
$tab_nbapp = array(5, 10, 30, 50);

//traitement des infos

//recuperation de l'annee et du mois
$annee = -1;
 if(isset($_GET['annee'])){
     $annee = (int) $_GET['annee'];
 }
$mois = -1;
 if(isset($_GET['mois'])){
     $mois = (int) $_GET['mois'];
 }

//nombre total d'actualites
$nb_actualites = get_nb_actualites($annee, $mois);

//definition du nombre d'actualites par page
$nbapp = get_nbapp($tab_nbapp);

//definition de la page actuelle
$numpage = get_numpage($nb_actualites, $nbapp);

//recherche du fil d'actualites selon les spécifications de l'utilisateur
$fil_actualites = get_fil_actualites2($numpage, $nbapp, $annee, $mois);

$nb_actualites_mois = get_nb_actualites_mois();

$nb_actualites_annee = get_nb_actualites_annee();

//Liste des mois
$liste_mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

foreach($fil_actualites as $cle => $elt){
    //formatage des chaines de caracteres
    $fil_actualites[$cle]['titre'] = htmlspecialchars($elt['titre']);
    $fil_actualites[$cle]['contenu'] = nl2br(htmlspecialchars($elt['contenu']));
    $fil_actualites[$cle]['image'] = htmlspecialchars($elt['image']);
}

//appel de la vue
//Par défaut 5 actualités par page et page 1
include_once('pages/fil_actualitesV.php');
?>