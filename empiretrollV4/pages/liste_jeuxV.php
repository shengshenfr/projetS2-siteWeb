<!--vue-->

<div class="page">
  <div class="portfolio">
  	<div class="title">
      	<h1>Liste des jeux trolls</h1>
      	<h3  align="right">Nombre de jeu par page</h3>
                    <div  class="numero" align="right">
                    <?php
                        foreach($tab_nbapp as $elt){
                    ?>
                    <a href="index.php?id_page=201&amp;nbapp=<?php echo $elt; ?>&amp;numpage=<?php echo $numpage; ?>">
                        <?php if($elt==$nbapp){echo '<span>';}?>
                        <?php echo $elt; ?>
                        <?php if($elt==$nbapp){echo '</span>';}?>&nbsp;&nbsp;&nbsp;
                    </a>
                    <?php
                        }
                    ?></div>
      	<br/>
	</div>
	<div id="conteneur">
		<?php
   			foreach($liste_jeux as $jeu){    
		?>
		<div class="tuile">
			<?php echo '<form method="post" name="information concret" action="index.php?id_page=202">
				<input type="hidden" name="ID" id="ID" value=' . $jeu[0] .'>';?>

				<?php
					/*if ($jeu[3][0]!="h"){
						list($width, $height) = getimagesize("http:".$jeu[3]);
					} else {
						list($width, $height) = getimagesize($jeu[3]);
					}
					
					$height_200w = (200*$height/$width);
					if ($height_200w>200) {
						$width_affichage = 200;
					} else {
						$width_affichage = ($width*200/$height);
					}*/$width_affichage = 200;
				?>

				<?php echo '<div class="tuile-content" style="width:'.$width_affichage.'px;">';?>
					<?php echo '<h3>'.$jeu['nom'].'</h3>';?>
					<?php
						foreach($res_genre[$jeu['id_jeu']] as $genre) {
							if(isset($genre)){
								echo code_name($genre,1).'<br/>';
							}
						}
					?>
				</div>
				<?php echo '<input type="image" src="'.$jeu[3].'" name="image" width="'.$width_affichage.'px" title="Accéder à la fiche du jeu">';?>
			</form>
		</div>
		<?php
			}
		?>
	</div>
	<br/>
	<h3>Page</h3>
	<div class="numero">
    	<?php
        	for($i = 0 ; $i * $nbapp < $nb_jeux ; $i ++){
    	?>
        	<a href="index.php?id_page=201&amp;nbapp=<?php echo $nbapp; ?>&amp;numpage=<?php echo $i; ?>">
                <?php if($i==$numpage){echo '<span>';}?>
                <?php echo $i + 1; ?>
                <?php if($i==$numpage){echo '</span>';}?>
        	</a>&nbsp;&nbsp;&nbsp;
    	<?php
        	}
    	?>
	</div>
  </div>
</div>