<!--modele-->

<?php

function get_liste_jeux(){
	global $bdd;
	$query="SELECT id_jeu,nom,designer,image,langue FROM `projet_dev_test`.jeu"; 
    $result=$bdd->prepare($query);     
    $result->execute();                
    $res=$result->fetchAll();

   if(isset($_POST['ID'])){
        echo $_POST['ID'].'This is the ID';
    }
    return $res;
}

function get_liste_jeux2($numpage, $nbapp){
    global $bdd;
    $query="SELECT id_jeu,nom,designer,image,langue FROM `projet_dev_test`.jeu LIMIT " . $numpage * $nbapp . "," . $nbapp;
    $result=$bdd->prepare($query);     
    $result->execute();                
    $res=$result->fetchAll();

   if(isset($_POST['ID'])){
        echo $_POST['ID'].'This is the ID';
    }
    return $res;
}

function get_genre($id_jeu){
	global $bdd;
    $query_genre="SELECT id_genre FROM `projet_dev_test`.jeu_genre WHERE id_jeu=:id_jeu";
    $result_genre=$bdd->prepare($query_genre);     
    $result_genre->execute(array('id_jeu' => $id_jeu));                
    $id_genre = $result_genre->fetchAll();
    $id_genre = array_column($id_genre, 'id_genre');
    $genres = array();
    foreach($id_genre as $id){
        $query_genre="SELECT genre FROM `projet_dev_test`.genre WHERE id_genre=:id";
        $result_genre=$bdd->prepare($query_genre);     
        $result_genre->execute(array('id' => $id));                
        $result_genre = $result_genre->fetch();
        array_push($genres, $result_genre[0]);
    } 
	return $genres;
}

//pour avoir le nombre de jeu par page
function get_nbapp($tab_nbapp){
    //definition d'une valeur par defaut
    $nbapp = $tab_nbapp[0];
    if(isset($_GET['nbapp'])){//si une valeur est specifiee
        //adaptation de la valeur
        $demande = (int) $_GET['nbapp'];
        if(in_array($demande, $tab_nbapp)){
            $nbapp = $demande;
        }
    }
    return $nbapp;
}

//pour avoir le numero de la page
function get_numpage($nb_actualites, $nbapp){
    //definition d'une valeur par defaut
    $numpage = 0;
    if(isset($_GET['numpage'])){//si une valeur est specifiee
        //adaptation de la valeur
        $numpage = (int) $_GET['numpage'];
        if($nb_actualites <= $numpage * $nbapp){
            $numpage = 0;
        }
    }
    return $numpage;
}

function get_nb_jeux(){
    global $bdd;
    //construction de la requete
    $requete = 'SELECT COUNT(*) FROM jeu';
    //execution de la requete
    $req = $bdd->query($requete);
    $nb_jeux = (int) $req->fetch()['COUNT(*)'];
    $req->closeCursor();
    
    return $nb_jeux;
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