<!--Controleur-->
<?php
// Ce controleur gère tout le formulaire d'ajout de jeu dans la BDD
if($estAdmin){
    // On commence par importer toutes les fonctions qui servent à traiter les formulaires et changer la BDD
    include_once('armoires/ajouter_jeuM.php');

    // Si on a pas encore commencer le formulaire, ou qu'à la fin d'un formulaire on à choisit d'en rajouter un, on va sur la première page.
    if (!isset($_POST['nom0']) AND !isset($_POST['echec']) AND !isset($_POST['reussite']) AND !isset($_POST['bypass']) AND !isset($_POST['jump']) AND !isset($_POST['quitter'])){
        include_once('pages/ajouter_jeu_etape1V.php');   
    }
    // Ces deux vecteurs servent à parcourir les colonnes de la BDD
    $data = array('designer', 'min_joueur', 'max_joueur', 'image', 'duree');
    $collumn = array('langue','datum','extension','id_editeur','genre','complexite','etat','degradation','id_proprietaire');
    
    if (isset($_POST['nom0'])){
        $_POST['nom0'] = htmlspecialchars($_POST['nom0']);
        $nom = $_POST['nom0'];
        // Si on a réussit à trouver le jeu dans BoardGameGeek, et à le rajouter dans la BDD
        if (insert_game($nom)){
            // On appel chaque données de $data pour les utiliser dans la suite du formulaire
            foreach($data as $dt){
                $$dt = get_data($nom,$dt);
            }
            // On met finalement la suite du formulaire
            include_once('pages/ajouter_jeu_etape2V.php'); 
        }
        // Sinon on demander de vérifier le nom qu'on a tapé ou d'aller chercher l'ID BoardGameGeek du jeu
        else{
            include_once('pages/ajouter_jeu_etape2bisV.php');
        }
    }
    // Si on veut tout rentrer à la main
    if (isset($_POST['bypass'])){
        include_once('pages/ajouter_jeu_etape2bypassV.php');
    }
    // Si on a rentré l'ID du jeu
    if (isset($_POST['echec'])){
        $_POST['echec'] = htmlspecialchars($_POST['echec']);
        $_POST['ID'] = htmlspecialchars($_POST['ID']);
        $nom = $_POST['echec'];
        $ID = $_POST['ID'];
        // On reteste si on arrive à ajouter le jeu
        if (insert_game($nom,$ID)){
            $data = array('designer', 'min_joueur', 'max_joueur', 'image', 'duree');
            foreach($data as $dt){
                $$dt = get_data($nom,$dt);
            }
            include_once('pages/ajouter_jeu_etape2V.php'); 
        }
        else{
            include_once('pages/ajouter_jeu_etape2bisV.php');
        }
    }
    // Si on est à l'étape trois (on a vérifié les données)
    if (isset($_POST['reussite'])){
        $_POST['reussite'] = htmlspecialchars($_POST['reussite']);
        $nom = $_POST['reussite'];
        $editeurs = get_allEditeurs();
        $genres = get_allGenres();
        $pseudos = get_allPseudos();
        // On rajoute le nom dans les colonnes à changer
        array_push($data,'nom');
        // On va vérifier si on a rentrer des trucs à modifier
        foreach($data as $dt){
            if (preg_match("#[0-9A-Za-z]#",$_POST[$dt])){
                change_game($nom,$dt,$_POST[$dt]);
            }
        }
        // On met à jour le nom utilisé pour trouver le jeu
        if (preg_match("#[0-9A-Za-z]#",$_POST['nom'])){
            $_POST['nom'] = htmlspecialchars($_POST['nom']);
            $nom = $_POST['nom'];
        }
        else{
            $nom = $_POST['reussite'];
        }
        include_once('pages/ajouter_jeu_etape3V.php');
    }
    // Si on a choisit de tout rentrer à la main
    if (isset($_POST['jump'])){
        $_POST['nom'] = htmlspecialchars($_POST['nom']);
        $nom = $_POST['nom'];
        $editeurs = get_allEditeurs();
        $genres = get_allGenres();
        $pseudos = get_allPseudos();
        add_game($nom);
        foreach($data as $dt){
            if (preg_match("#[0-9A-Za-z]#",$_POST[$dt])){
                $_POST[$dt] = htmlspecialchars($_POST[$dt]);
                change_game($nom,$dt,$_POST[$dt]);
            }
        }
        include_once('pages/ajouter_jeu_etape3V.php');
    }
    // Si on a fini le formulaire
    if (isset($_POST['fin'])){

        $nom=$_POST['fin'];
        // On va rajouter l'id de l'éditeur dans la base SQL, selon si on en a selectionner un existant ou rajouté un
        if (isset($_POST['editeur']) OR isset($_POST['addEditeur'])){
            if (isset($_POST['editeur'])){
                $editeur = $_POST['editeur'];
                echo $editeur;
                $editeurID = get_editeurID($editeur);
                echo $editeurID;
            }
            else{
                $_POST['addEditeur'] = htmlspecialchars($_POST['addEditeur']);
                $editeur = $_POST['addEditeur'];
                $addEditeur = $_POST['addEditeur'];
                $editeurID = get_editeurID($editeur,$addEditeur);
                echo $editeurID;
            }
            change_game($nom,'id_editeur',$editeurID);
        }

        // On rajoute les différentes informations rentrées
        $form = array('datum','extension','degradation','complexite');
        foreach($form as $cl){
            if (isset($_POST[$cl])){
                $_POST[$cl] = htmlspecialchars($_POST[$cl]);
                change_game($nom,$cl,$_POST[$cl]);
            }
        }

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

        $langue = get_langue($_POST['langue']);
        change_game($nom,'langue',$langue);

        
        if (!($_POST['pseudo'][0] == " ")){
            $membreID = get_pseudoID($_POST['pseudo'][0]);
            change_game($nom,'id_membre',$membreID);

        // Changer l'état
        }
    }
    // Si on ne veut plus rajouter de jeu
    if (isset($_POST['quitter'])){
        header('Location: index.php');
    }
} 
else {
    //Si l'utilisateur n'est pas un administrateur retour à l'index
    header('Location: index.php');
}
?>