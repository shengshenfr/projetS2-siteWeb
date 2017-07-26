<!--modeles-->

<?php

function listeGenres() {
    global $bdd;
	$query="SELECT genre  FROM genre ORDER BY genre";
    $result=$bdd->prepare($query);
    $result->execute();
    $res=$result->fetchAll();
    return $res;
}

?>