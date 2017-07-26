<!-- Ce fichier regroupe les fonctions qui servent à modifier la table des jeux ainsi que quelques autres fonctions qui sont utiliser lors de l'ajout d'un jeu -->

<?php
include_once('recup_info_bggM.php');

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=projet_dev_test;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

function code_name($string,$sens){ // Dans le sens 1 ont remplace "_" par " " et vice versa dans l'autre sens
    if ($sens==1){
        $string = preg_replace("#_#", " ", $string);
    }
    else{
        $string = preg_replace('# #', "_", $string);   
    }
    return $string;
}

// Cette fonction cherche laquelle des langues a été coché dans le questionnaire
function get_langue($langues){
    $langue = '';   // On crée ici le string contenant les langues du jeu
    foreach ($langues as $lg) {
        $langue = $langue . ',' . $lg;
    }
    $langue = substr($langue, 1, strlen($langue));
    return $langue;
}

// Cette fonction renvoie l'ensemble des éditeurs présent dans la BDD
function get_allEditeurs(){
    global $bdd; // On utilise la BDD
    $reponse = $bdd->query('SELECT editeur FROM `projet_dev_test`.editeur');
    $editeurs = $reponse->fetchAll(); // On obtient ici une matrice
    return $editeurs;
}

// Cette fonction sert à retrouver l'id de l'éditeur. Si l'éditeur n'existait pas et qu'on l'a rajouté, cela le met dans la BDD et renvoie son ID.
function get_editeurID($editeur,$addEditeur = FALSE){ 
    global $bdd;
    if (preg_match("#[0-9A-Za-z]#",$addEditeur)){
        $req=$bdd->prepare('INSERT INTO editeur(editeur) VALUES (:editeur)'); // On ajoute l'éditeur qui a été rentré par l'utilisateur
        $req->execute(array(
            'editeur' => $addEditeur));
    }
    // O va maintenant chercher l'ID de l'éditeur dans la BDD.
    $reponse = $bdd->prepare("SELECT id_editeur FROM `projet_dev_test`.editeur WHERE editeur=:editeur");
    $reponse->execute(array(
        'editeur' => $editeur));
    $ID_editeur = $reponse->fetch();
    return $ID_editeur[0]; // La reponse étant un array, on selectionne le premier élément pour avoir l'ID
}

//Renvoie un vecteur contenant tous les genres de la BDD
function get_allGenres(){
    global $bdd; // On utilise la BDD
    $reponse = $bdd->query('SELECT genre FROM `projet_dev_test`.genre ORDER BY genre');
    $matrixGenres = $reponse->fetchAll(); // On obtient ici une matrice
    $genres = array();
    for ($i = 0; $i < count($matrixGenres); $i++){
        array_push($genres,$matrixGenres[$i][0]);
    }
    return $genres;
}

// On prend en entrée  le formulaire des genres rempli ou non et les cases d'ajout de genre sous forme de vecteur
function get_genreID($genre, $addGenre){ 
    global $bdd;
    $IDs_genres = array();
    for ($i = 0; $i < count($addGenre); $i++){
        if (preg_match("#[0-9A-Za-z]#",$addGenre[$i])){
            $req=$bdd->prepare('INSERT INTO `projet_dev_test`.genre(genre) VALUES (:genre)'); // On ajoute l'éditeur qui a été rentré par l'utilisateur
            $req->execute(array(
                'genre' => $addGenre[$i]));
            array_push($genre,$addGenre[$i]);
        }
    }
    foreach ($genre as $g){
        $reponse = $bdd->prepare("SELECT id_genre FROM `projet_dev_test`.`genre` WHERE genre=:genre"); // SI c'ets le cas on cherche son id
        $reponse->execute(array(
            'genre' => $g));
        $ID_genre = $reponse->fetch();
        array_push($IDs_genres, $ID_genre[0]);
    }
    return $IDs_genres;
}

//Renvoie un vecteur contenant tous les membres enregistrés
function get_allPseudos(){
    global $bdd; // On utilise la BDD
    $reponse = $bdd->query('SELECT pseudo FROM `projet_dev_test`.membres');
    $matrixPseudos = $reponse->fetchAll(); // On obtient ici une matrice
    $pseudos = array();
    for ($i = 0; $i < count($matrixPseudos); $i++){
        array_push($pseudos,$matrixPseudos[$i][0]);
    }
    return $pseudos;
}

function get_pseudoID($pseudo){ // On prend en entrée un pseudo dont on cherche l'id
    global $bdd;
    // On va maintenant chercher l'ID du pseudor dans la BDD.
    $reponse = $bdd->prepare("SELECT id FROM `projet_dev_test`.membres WHERE pseudo=:pseudo");
    $reponse->execute(array(
        'pseudo' => $pseudo));
    $ID_pseudo = $reponse->fetch();
    return $ID_pseudo[0]; // La reponse étant un array, on selectionne le premier élément pour avoir l'ID
}

function add_game($nom){
    global $bdd;
    $req = $bdd->prepare('INSERT INTO jeu(nom) VALUES (:nom)');
    $req->execute(array(
    'nom' => $nom));
    return TRUE;
}

function insert_game($nom, $ID = FALSE){ // Cette fonction ajoute un jeu dans la base de données ainsi que totues les informations qu'on trouve sur BGG
    global $bdd;
    if (preg_match("#[0123456789]#",$ID)){ // Si on nous a donné l'ID, on l'utilise
    }
    else{       // Sinon on utilise le nom pour trouver l'ID
        if (get_gameID($nom)){
            $ID = get_gameID($nom);
        }
        else{
            return FALSE;
        }
    }

    $directory = 'https://www.boardgamegeek.com/xmlapi/boardgame/' . $ID . '?stats=1'; // Page surlaquelle on ira chercher nos informations
    $file = @fopen($directory, 'r'); // On verifie que l'on arrive à ouvrir le lien 
    if (!$file){
        return FALSE;
        break;
    } 
    $donnees = file($directory); // On importe les données de la page
    $chaineDonnees = implode($donnees); //Transformation du tableau en une unique chaîne de caractère
    
    $designer = get_designer($chaineDonnees); // On cherche l'auteur
    $nbPlayers = get_nbPlayers($chaineDonnees);  // On cherche le nombre de joueur max et min
    $minPlayers = $nbPlayers[0];  // Le premier caractère sera toujours le nombre minimum
    if (strlen($nbPlayers) == 2){   // Si jamais $nbPlayers est de longueur deux, le nombre max est à un chiffre, sinon il a deux chiffres
        $maxPlayers = $nbPlayers[1];
    }
    else{
        $maxPlayers = $nbPlayers[1].$nbPlayers[2];
    }
    $duree = get_duree($chaineDonnees); // On cherche la durée moyenne d'une partie et on l'affiche
    $image =  get_image($chaineDonnees);  // On va chercher le lien vers l'image
    // On peut finallement préparer notre requête SQL qui ajoutera le jeu à la BDD
    $req = $bdd->prepare('INSERT INTO jeu(nom, designer, min_joueur, max_joueur, duree, image) VALUES (:nom, :designer, :min_joueur, :max_joueur, :duree, :image)');
    $req->execute(array(
    'nom' => $nom,
    'designer' => $designer,
    'min_joueur' => $minPlayers,
    'max_joueur' => $maxPlayers,
    'duree' => $duree,
    'image' => $image
    ));
    return TRUE;
}

function change_game($nom,$champ,$new_value){ // Modifie un champ d'un jeu de la BDD
    global $bdd;
    $request = 'UPDATE `projet_dev_test`.`jeu` SET '. $champ.' =:value WHERE nom=:nom';
    $req = $bdd->prepare($request);
    $req ->execute(array(
        'value' => $new_value,
        'nom' => $nom));
}

function add_genre($nom,$id_genre){ // Modifie un champ d'un jeu de la BDD
    global $bdd;
    $request = 'SELECT id_jeu FROM `projet_dev_test`.`jeu` WHERE `jeu`.`nom` =:nom';
    $req = $bdd->prepare($request); // Puis on selectionne son id
    $req ->execute(array(
        'nom' => $nom));
    $id_jeu = $req->fetch();
    $id_jeu = $id_jeu[0];
    $req = $bdd->prepare('INSERT INTO `projet_dev_test`.jeu_genre(id_jeu,id_genre) VALUES (:id_jeu,:id_genre)');
    $req->execute(array(
    'id_jeu' => $id_jeu,
    'id_genre' => $id_genre));
}

function get_data($nom,$collumn){
    global $bdd;
    $request = 'SELECT '. $collumn .' FROM `projet_dev_test`.`jeu` WHERE `jeu`.`nom` =:nom';
    $req = $bdd->prepare($request); // Puis on selectionne son id
    $req ->execute(array(
        'nom' => $nom));
    $data = $req->fetchAll();
    return $data[0][0];
}
