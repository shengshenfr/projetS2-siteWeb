<!--controleur-->

<?php

//insertion du modele
include_once('actualite/fil_actualitesM.php');

//booleen de page valide
$valide = false;

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
$nbapp = get_nbapp(array(5, 10, 30, 50));

//definition de la page actuelle
$numpage = get_numpage($nb_actualites, $nbapp);

//recherche du fil d'actualites selon les spécifications de l'utilisateur
$fil_actualites = get_fil_actualites2($numpage, $nbapp, $annee, $mois);

?>

<!--vue-->

<!--Carousel-->
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/coin-slider.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/coin-slider.css" />

<div class="page mar-top30"> <!--Corps de page-->

<!--carousel-->
  <div class="slider">
    <div id="coin-slider">

      <!--Article le plus récent-->
      <a href="index.php?id_page=101&amp;id_actualite=<?php echo $fil_actualites[0]['id_actualite']; ?>"> <!--Lien vers le détail de l'article-->
      <img src="<?php echo $chemin_images . $fil_actualites[0]['image']; ?>" alt="C'était pour faire joli :'(" width="960" height="360"/>
      <span><big><?php echo $fil_actualites[0]['titre']; ?></big><br/> <!--Affichage du titre de l'article-->
      <?php echo $fil_actualites[0]['contenu']; ?></span></a> <!--Affichage du contenu de l'article-->

      <!--Avant dernier article-->
      <a href="index.php?id_page=101&amp;id_actualite=<?php echo $fil_actualites[1]['id_actualite']; ?>">
      <img src="<?php echo $chemin_images . $fil_actualites[1]['image']; ?>" alt="C'était pour faire joli :'(" width="960" height="360"/>
      <span><big><?php echo $fil_actualites[1]['titre']; ?></big><br/>
      <?php echo $fil_actualites[1]['contenu']; ?></span></a>

      <!--Avant avant dernier article-->
      <a href="index.php?id_page=101&amp;id_actualite=<?php echo $fil_actualites[2]['id_actualite']; ?>">
      <img src="<?php echo $chemin_images . $fil_actualites[2]['image']; ?>" alt="C'était pour faire joli :'(" width="960" height="360"/>
      <span><big><?php echo $fil_actualites[2]['titre']; ?></big><br/>
      <?php echo $fil_actualites[2]['contenu']; ?></span></a> </div>

    <div class="clearing"></div>
  </div>
  <div class="clearing"></div>
<!--carousel-end-->

</div> <!--Fin corps de page-->