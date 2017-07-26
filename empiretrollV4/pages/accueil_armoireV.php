<!--vue-->

<div class="page">
  <div class="portfolio">
    <div class="title">
      <h1>Les armoires trolls</h1>
      <h2>Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus hasellus ultrices nulla quis nibh. Quisque a lectus.</h2>
    </div>

    <!--Recheche de jeu-->

    <div class="search">
      <center>
        <h2><a href="index.php?id_page=201">Afficher tous les jeux</a></h2>
      </center>

      <h1>Trouver un jeu</h1>
      <ul>
        <li>
          <input name="" type="text"  class="text-filed"/>
        </li>
        <li><a href="#"><img src="images/search-bt.jpg" alt="search" /></a></li>
      </ul>
    </div>
    <div class="clearing"></div>

    <!--Recherche de jeu-end-->


    <?php
      $i=0;
      foreach($liste_genres as $genre) {
        if(($i==0)||($i==1)) {
          $i+=1;
    ?>
    <div class="panel mar-right30">
      <div class="content"> <img src="images/img_categorie_jeu.jpg" />
        <p><span><?php echo $genre[0] ?></span></p>
        <a href="#">visiter le rayon</a> </div>
    </div>

    <?php
      } elseif($i==2) {
        $i=0;
    ?>
    <div class="panel">
      <div class="content"> <img src="images/img_categorie_jeu.jpg" />
        <p><span><?php echo $genre[0] ?></span></p>
        <a href="#">visiter le rayon</a> </div>
    </div>

    <?php } } ?>

  </div>
</div>