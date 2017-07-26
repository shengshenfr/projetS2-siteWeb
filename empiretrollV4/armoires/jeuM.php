<!--modele-->

<?php

function get_jeu($i){
	global $bdd;
	$query_jeu="SELECT * FROM jeu WHERE id_jeu='$i'"; 
    $result_jeu=$bdd->prepare($query_jeu);     
    $result_jeu->execute();                
    $res_jeu=$result_jeu->fetchAll();
    return $res_jeu;
}

function get_commentaire($i) {
	global $bdd;
	$query_commentaire="SELECT * FROM commentaire WHERE id_jeu='$i'"; 
    $result_commentaire=$bdd->prepare($query_commentaire);     
    $result_commentaire->execute();                
    $res_commentaire=$result_commentaire->fetchAll();
    return $res_commentaire;
}

function get_editeur($id_editeur) {
	global $bdd;
	$query_editeur="SELECT * FROM editeur WHERE id_editeur='$id_editeur'"; 
    $result_editeur=$bdd->prepare($query_editeur);     
    $result_editeur->execute();                
    $res_editeur=$result_editeur->fetchAll();
    return $res_editeur;
}

function get_id_genre($id_jeu){
    global $bdd;
    $id_genre = array();
    $query_id_genre="SELECT id_genre FROM jeu_genre WHERE id_jeu=:id_jeu";
    $result_id_genre=$bdd->prepare($query_id_genre);     
    $result_id_genre->execute(array('id_jeu' => $id_jeu));                
    $id_genre = $result_id_genre->fetchAll();
    $id_genre = array_column($id_genre, 'id_genre');
    return $id_genre;
}

function get_genre($id_genre) {
	global $bdd;
    $res_genre=[];
    foreach($id_genre as $genre){
        $query_genre="SELECT genre FROM genre WHERE id_genre='$genre'";
        $result_genre=$bdd->prepare($query_genre);     
        $result_genre->execute();                
        array_push($res_genre, $result_genre->fetch()[0]);
    }
	return $res_genre;
}

function get_membre($id_jeu){
    global $bdd;
    // On commence pas chercher l'identifiant du membre dans la table jeu
    $query_id_membre="SELECT id_proprietaire FROM jeu WHERE id_jeu=:id_jeu";
    $result_id_membre=$bdd->prepare($query_id_membre);     
    $result_id_membre->execute(array('id_jeu' => $id_jeu));                
    $id_membre = $result_id_membre->fetch()[0];
    // Puis on va chercher son pseudo dans la table membre
    $query_membre="SELECT pseudo FROM membres WHERE id='$id_membre'";
    $result_membre=$bdd->prepare($query_membre);     
    $result_membre->execute();                
    $membre = $result_membre->fetch()[0];
    return $membre;
}



function supprimer_jeu($id_jeu){
    global $bdd;
    $req = $bdd->prepare('DELETE FROM `projet_dev_test`.`jeu` WHERE `jeu`.`id_jeu` =:id_jeu'); // Puis on selectionne son id
    $req ->execute(array(
        'id_jeu' => $id_jeu));
    $req = $bdd->prepare('DELETE FROM `projet_dev_test`.`jeu_genre` WHERE `jeu_genre`.`id_jeu` =:id_jeu'); // Puis on selectionne son id
    $req ->execute(array(
        'id_jeu' => $id_jeu));
}