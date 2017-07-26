<!--controleur-->

<?php

include_once("armoires/jeuM.php");
include_once("armoires/ajouter_jeuM.php");

try
{ 
    if(!isset($_POST['ID']) AND !isset($_POST['id']) and !isset($_POST['suppr']) and !isset($_POST['modif']) and !isset($_POST['change']) and !isset($_POST['confirm_suppr']) or isset($_POST['cancel'])){
        header('Location: index.php?id_page=201');
    }

    // Si on a choisit un jeu, on l'affiche
	if(isset($_POST['ID'])){

    	$id=$_POST['ID'];
    
    	$res_jeu = get_jeu($id);
    	$id_editeur=$res_jeu[0]['id_editeur'];
    	$res_commentaire = get_commentaire($id);
    	$res_editeur = get_editeur($id_editeur);
        $id_genre = get_id_genre($id);
    	$res_genre = get_genre($id_genre);

		include_once("pages/jeuV.php");
	}

    // Si on a choisit de modifier l'état ou la dégradation du jeu, on demande confirmation
    if(isset($_POST['etat']) or isset($_POST['degradation']) and $estAdmin){
        $id = $_POST['id'];
        $jeu = get_jeu($id);
        if(isset($_POST['etat'])){
            $old_value = $jeu[0]['etat'];
            $new_value = $_POST['etat'];
            $changement = "l'état";
            $column = 'etat';
        }
        else{
            $old_value = $jeu[0]['degradation'];
            $new_value = $_POST['degradation'];
            $changement = 'la dégradation';
            $column = 'degradation';
        }

        include_once("pages/modif_etat_deg_jeuV.php");
    }

    if (isset($_POST['change']) and $estAdmin){
        $jeu = get_jeu($_POST['id']);
        change_game($jeu[0]['nom'],$_POST['column'],$_POST['new_value']);
        header('Location: index.php?id_page=201');
    }

    // Si on a choisit de modifier la suppression du jeu, on demande confirmation
    if (isset($_POST['suppression']) and $estAdmin){
        $id = $_POST['suppr'];
        $jeu = get_jeu($id);
        include_once("pages/confirm_supprV.php");
    }

    if (isset($_POST['confirm_suppr']) and $estAdmin){
        $id = $_POST['id'];
        supprimer_jeu($id);
        header('Location: index.php?id_page=201');
    }

    // Si on a demandé à changer le jeu, on redirige vers une page de modification du jeu
    if (isset($_POST['modification']) and $estAdmin){
        $id = $_POST['modif'];
        $jeu = get_jeu($id)[0];
        $id_genre = get_id_genre($jeu['id_jeu']);
        $genre = get_genre($id_genre);
        $langue = explode("#, ",$jeu['langue']);
        $membre = get_membre($id);
        $editeurs = get_allEditeurs();
        $genres = get_allGenres();
        $pseudos = get_allPseudos();
        include_once('pages/modif_jeuV.php');
    }

    if(isset($_POST['modifV2']) and $estAdmin){

        $id=$_POST['ID'];
    
        $res_jeu = get_jeu($id);
        $id_editeur=$res_jeu[0]['id_editeur'];
        $res_commentaire = get_commentaire($id);
        $res_editeur = get_editeur($id_editeur);

        // On rajoute les genres
        $_POST['addGenre0'] = htmlspecialchars($_POST['addGenre0']);
        $_POST['addGenre1'] = htmlspecialchars($_POST['addGenre1']);
        $_POST['addGenre2'] = htmlspecialchars($_POST['addGenre2']);
        $addGenre = array($_POST['addGenre0'], $_POST['addGenre1'], $_POST['addGenre2']);
        $genre = $_POST['genre'];
        if ($genre[count($genre)-1] == " "){
            $genre = array_slice($genre, 0, count($genre)-1);
        }
        $genreID = get_genreID($genre, $addGenre);
        foreach ($genreID as $id) {
            add_genre($nom,$id);
        }
        $res_genre = get_genre($id_genre);

        include_once("pages/jeuV.php");
    }
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

?>s