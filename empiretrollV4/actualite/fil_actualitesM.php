<!--modele-->

<?php

/*
//pour aller chercher l'ensemble des actualites
function get_fil_actualites_total($numpage, $nbapp){
    global $bdd;
    //requete
    $req = $bdd->query(
        'SELECT a.id AS id_actualite, titre, DATE_FORMAT(date_creation, \'Le %d/%m/%Y à %Hh%imin%ss\') AS date, contenu, i.nom AS image
        FROM actualites AS a
        INNER JOIN images AS i
        ON a.id_image = i.id
        ORDER BY date DESC ');
        LIMIT ' . $numpage * $nbapp . ', ' . $nbapp);
    //entree des donnees dans un tableau
    $fil_actualites = $req->fetchAll();
    $req->closeCursor();
    
    return $fil_actualites;
}
*/

//pour connaitre le nombre d'actualites
function get_nb_actualites($annee, $mois){
    global $bdd;
    //construction de la requete
    $requete = 'SELECT COUNT(*)
        FROM actualites';
    if($annee != -1){
        $requete = $requete . ' WHERE YEAR(date_creation) = ' . $annee;
        if($mois != -1){
            $requete = $requete . ' AND MONTH(date_creation) = ' . $mois;
        }
    }
    //execution de la requete
    $req = $bdd->query($requete);
    $nb_actualites = (int) $req->fetch()['COUNT(*)'];
    $req->closeCursor();
    
    return $nb_actualites;
}//ok

//pour avoir le nombre d'actualites par mois
function get_nb_actualites_mois(){
    global $bdd;
    //requete
    $req = $bdd->query(
        'SELECT COUNT(*) AS nb,
            MONTH(date_creation) AS mois, 
            YEAR(date_creation) AS annee
        FROM actualites 
        GROUP BY annee, mois
        ORDER BY annee, mois DESC');
    $nb_actualites_mois = $req->fetchAll();
    $req->closeCursor();
    
    return $nb_actualites_mois;
}

//pour avoir le nombre d'actualites par annee
function get_nb_actualites_annee(){
    global $bdd;
    //requete
    $req = $bdd->query(
        'SELECT COUNT(*) AS nb, 
            YEAR(date_creation) AS annee 
        FROM actualites 
        GROUP BY annee');
    $nb_actualites_annee = $req->fetchAll();
    $req->closeCursor();
    
    return $nb_actualites_annee;
}
/*
//pour avoir les actualites d'un mois
function get_fil_actualites_mois($numpage, $nbapp, $annee, $mois){
    global $bdd;
    //requete
    $req = $bdd->query(
        'SELECT a.id AS id_actualite, 
            titre, 
            DATE_FORMAT(date_creation, \'Le %d/%m/%Y à %Hh%imin%ss\') AS date, 
            DATE_FORMAT(date_creation, %m) AS mois,
            DATE_FORMAT(date_creation, %Y) AS annee,
            contenu, 
            i.nom AS image
        FROM actualites AS a
        INNER JOIN images AS i
        ON a.id_image = i.id
        WHERE mois = ' . $mois . ' AND annee = ' . $annee . '
        ORDER BY date DESC 
        LIMIT ' . $numpage * $nbapp . ', ' . $nbapp);
    //entree des donnees dans un tableau
    $fil_actualites_mois = $req->fetchAll();
    $req->closeCursor();
    
    return $fil_actualites;
}

//pour avoir les actualites d'un mois
function get_fil_actualites_annee($numpage, $nbapp, $annee){
    global $bdd;
    //requete
    $req = $bdd->query(
        'SELECT a.id AS id_actualite, 
            titre, 
            DATE_FORMAT(date_creation, \'Le %d/%m/%Y à %Hh%imin%ss\') AS date, 
            DATE_FORMAT(date_creation, %Y) AS annee
            contenu, 
            i.nom AS image
        FROM actualites AS a
        INNER JOIN images AS i
        ON a.id_image = i.id
        WHERE annee = ' . $annee . '
        ORDER BY date DESC 
        LIMIT ' . $numpage * $nbapp . ', ' . $nbapp);
    //entree des donnees dans un tableau
    $fil_actualites_mois = $req->fetchAll();
    $req->closeCursor();
    
    return $fil_actualites;
}
*/

//pour avoir le nombre d'actualites par page
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
}//ok

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
}//ok

/*
//pour aller chercher les actualites specifiees
function get_fil_actualites($numpage, $nbapp){
    if(isset($_GET['annee'])){
        if(isset($_GET['mois']) AND 1 <= (int) $_GET['mois'] AND (int) $_GET['mois'] <= 12){
            $fil_actualites = get_fil_actualites_mois($numpage, $nbapp, (int) $_GET['annee'], (int) $_GET['mois']);
        }
        else{
            $fil_actualites = get_fil_actualites_annee($numpage, $nbapp, (int) $_GET['annee']);
        }
    }
    else{
        $fil_actualites = get_fil_actualites_total($numpage, $nbapp);
    }
}
*/

//pour avoir les actualites d'un mois
function get_fil_actualites2($numpage, $nbapp, $annee, $mois){
    global $bdd;
    //construction de la requete
    $requete = 'SELECT a.id AS id_actualite, 
            titre, 
            DATE_FORMAT(date_creation, \'Le %d/%m/%Y à %Hh%imin%ss\') AS date, 
            contenu, 
            i.nom AS image
        FROM actualites AS a
        INNER JOIN images AS i
        ON a.id_image = i.id';
    if($annee != -1){
        $requete = $requete . ' WHERE YEAR(date_creation) = ' . $annee;
        if($mois != -1){
            $requete = $requete . ' AND MONTH(date_creation) = ' . $mois;
        }
    }
    $requete = $requete . ' ORDER BY date_creation DESC 
        LIMIT ' . $numpage * $nbapp . ', ' . $nbapp;
    
    //execution de la requete
    $req = $bdd->query($requete);
    
    //entree des donnees dans un tableau
    $fil_actualites = $req->fetchAll();
    $req->closeCursor();
    
    return $fil_actualites;
}//ok


?>