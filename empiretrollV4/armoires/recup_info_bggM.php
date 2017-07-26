<!-- Ce fichier regroupe toutes les fonctions qui vont chercher les informations sur BGG
On a:
get_gameID qui cherche l'identifiant BGG du jeu via son nom
get_nbPlayers qui cherche les nombres limite de joueur via l'identifiant BDD du jeu
get_duree qui cherche la duree moyenne du jeu via l'identifiant BGG du jeu
get designer qui cherche l'auteur du jeu via l'identifiant BGG du jeu
get_image qui cherche le lien de l'image du jeu via l'identifiant du jeu -->

<?php
function get_gameID($nom) // On cherche l'id du jeu de boardgamegeek
{   
    $directory = "https://www.boardgamegeek.com/xmlapi/search?search=" . urlencode($nom); // On crée le lien pour chercher le jeu dans la BDD de board game geek
    $file = @fopen($directory, 'r'); // On verifie que l'on arrive à ouvrir le lien 
    if (!$file){
        return FALSE;
        break;
    } 
    $donnees = file($directory, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); // On importe les données de la page
    $chaineDonnees = implode($donnees); //Transformation du tableau en une unique chaîne de caractère
    $nom = htmlspecialchars($nom); // On change le format du $nom pour que la recherche marche bien
    // On vire  les "'" pour éviter les bugs
    $patterns = array();  
    $patterns[0] = "/'/"; 
    $replacements = array(); 
    $replacements[0] = '&#039;'; 
    $nom = preg_replace($patterns, $replacements, $nom);
    $position = strripos($chaineDonnees, ">".$nom."<"); // Recherche de la position du nom du jeu dans la page
    if (preg_match("#[0123456789]#", $position)) // Si on a trouvé une position <=> position est un chiffre
    {
        $iterateur = -7; // Itérateur pour parcourir le code source de la page
        $testLetter = 0; // Passe à 1 lorsqu'on croise un chiffre ( ce sera l'ID du jeu)
        $testNumber = 0; // Passe à 1 lorsqu'on croise un '"' après avoir croisé l'ID
        $ID = '';
        while ($testNumber == 0) // Boucle qui dure jusqu'à ce qu'on ai dépassé l'ID
       {   
           $iterateur = $iterateur - 1; // On met à jour l'itérateur
           if ($testLetter ==0) // Si on a toujours pas croisé de chiffre
          {
                if (preg_match("#[0123456789]#", $chaineDonnees[$position+$iterateur])) // On teste si le caratère actuel est un chiffre
                {
                    $ID = $chaineDonnees[$position+$iterateur]; // Si ça en est un, on l'ajoute à l'ID 
                    $testLetter = 1; // Et on informe qu'on a croisé un chiffre
                } 

            }
            else // Si on a déjà croisé un chiffre
            {
                if (preg_match('#"#', $chaineDonnees[$position+$iterateur])) // On vérifie si le caractère présent est un chiffre
                {
                    $testNumber =1; // Si c'est pas le cas, on sort de la boucle 
                }
                else
                {
                    $ID = $chaineDonnees[$position+$iterateur] . $ID; // Sinon on ajoute le chiffre à l'ID
                }
            }
        }
    return $ID; 
    }
    else // Si on a pas trouvé de position, on renvoie FALSE
    {
    return FALSE;
    }
}

function get_nbPlayers($chaineDonnees) // La fonction prends en entrée la page html déjà convertit en string pour gagner du temps
{   
    $position = strrpos($chaineDonnees, '<minplayers>'); // Recherche de la position du nom du jeu dans la page
    if (preg_match("#[0123456789]#", $position)) // On verifie que l'on ait une position valide
    {
        $iterateur = 11; // On initialise l'iterateur qui nous permet de parcourir le $chaineDonnees
        $testLetter = 0; // Passe à 1 lorsqu'on croise un chiffre et retourne à 0 quand on croise "<"
        $testNumber = 0; // Est incrémentée quand on croise "<" qui signifie qu'on a finit de lire un nombre
        $nbPlayers = ''; // Variable où on stockera le nombre de joueurs
        while ($testNumber < 2) // Tant qu'on a pas croisé deux nombres, on continu
       {   
           $iterateur = $iterateur + 1; 
           if ($testLetter == 0) 
           {
                if (preg_match("#[0123456789]#", $chaineDonnees[$position+$iterateur])) // On vérifie si l'élément testé est un chiffre
                {
                    $nbPlayers = $nbPlayers . $chaineDonnees[$position+$iterateur]; // Si c'est le cas, on l'ajoute à $nbPlayers
                    $testLetter = 1; // Et on passe dans le "else" pour la prochaine itération
                }

            }
            else
            {
                if (preg_match('#<#', $chaineDonnees[$position+$iterateur])) // Vérifie si on est toujours dans les chiffres
                {
                    $testNumber = $testNumber + 1; // On informe qu'on a gérer un nombre (on doit en prendre deux: le min et le max)
                    $testLetter = 0; // On retourne dans le boucle où on cherche un chiffre
                }
                else // Si c'est un chiffre, on l'ajoute
                {
                    $nbPlayers = $nbPlayers . $chaineDonnees[$position+$iterateur]; 
                }
            }
    }
    return $nbPlayers;
    }
    else
    {
    return FALSE;
    }
}

function get_duree($chaineDonnees) // La fonction prends en entrée la page html déjà convertit en string pour gagner du temps
{	
    $position = strrpos($chaineDonnees, '<playingtime>'); // Recherche de la position du nom du jeu dans la page
    if (preg_match("#[0123456789]#", $position)) // On vérifie que l'on ait une position valide
    {
        // Même logique que get_gameID sauf qu'on parcours le string dans l'autre sens, donc on met à jour $duree à droite et non à gauche
        $iterateur = 11;
        $testLetter = 0;
        $testNumber = 0;
        $duree = '';
        while ($testNumber == 0)
       {   
           $iterateur = $iterateur + 1;
           if ($testLetter == 0)
           {
                if (preg_match("#[0123456789]#", $chaineDonnees[$position+$iterateur]))
                {
                    $duree = $duree . $chaineDonnees[$position+$iterateur];
                    $testLetter = 1;
                }

            }
            else
            {
                if (preg_match('#<#', $chaineDonnees[$position+$iterateur]))
                {
                    $testNumber = 1;
                    $duree = $duree;
                }
                else
                {
                    $duree = $duree . $chaineDonnees[$position+$iterateur];
                }
            }
    }
    return $duree;
    }
    else
    {
    return FALSE;
    }
}	

function get_image($chaineDonnees) // La fonction prends en entrée la page html déjà convertit en string pour gagner du temps
{
    $position = strrpos($chaineDonnees, '<image>'); // Recherche de la position du nom du jeu dans la page
    if (preg_match("#[0123456789]#", $position)) // On vérifie que la position soit valide
    {
        $iterateur = 7;
        $testFin = 0; // Passera à 1 lorsqu'on quittera le lien vers l'image
        $urlImage = '/'; // Stocke l'url de l'image
        while ($testFin == 0)
       {   
           $iterateur = $iterateur + 1;
            if (preg_match('#<#', $chaineDonnees[$position+$iterateur]))
            {
                $testFin = 1;
            }
            else
            {
                $urlImage = $urlImage . $chaineDonnees[$position+$iterateur];
            }
        }
    return $urlImage;
    }
    else
    {
    return FALSE;
    }
}   

function get_designer($chaineDonnees) // La fonction prends en entrée la page html déjà convertit en string pour gagner du temps
{   
    $position = strrpos($chaineDonnees, '<boardgamedesigner'); // Recherche de la position du nom du jeu dans la page
    if (preg_match("#[0123456789]#", $position)) // On vérifie que l'on ait une position valide
    {
        // Même logique que searchID sauf qu'on parcours le string dans l'autre sens, donc on met à jour $duree à droite et non à gauche
        $iterateur = 29;
        $testLetter = 0;
        $testNumber = 0;
        $designer = '';
        while ($testNumber == 0)
       {   
           $iterateur = $iterateur + 1;
           if ($testLetter == 0)
           {
                if (preg_match("#>#", $chaineDonnees[$position+$iterateur]))
                {
                    $testLetter = 1;
                }

            }
            else
            {
                if (preg_match('#<#', $chaineDonnees[$position+$iterateur]))
                {
                    $testNumber = 1;
                    $designer = $designer;
                }
                else
                {
                    $designer = $designer . $chaineDonnees[$position+$iterateur];
                }
            }
    }
    return $designer;
    }
    else
    {
    return FALSE;
    }
}
?>