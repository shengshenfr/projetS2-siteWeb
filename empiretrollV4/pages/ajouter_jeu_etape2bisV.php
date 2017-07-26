<div class="page">
  <div class="portfolio">
		<div class="title">
            <h1>Ajout d'un jeu</h1>
            <br/>
        </div>

        <h2>Erreur lors de la première etape</h2>

        <div>
        	<p>
    		Problème d'ajout de ce jeu. <br />
		    Tu as bien voulu taper 
       		<?php 
    	    	echo $nom 
		    ?>
        	?
        	</p>
    	</div>
	    <div>
        	<p>
    	    Si c'est le cas, merci de rentrer l'ID BoardGameGeek du jeu.<br />
            Si tu ne sais pas comment le trouver, on a un tutoriel 
	        <?php 
                $directory = "https://www.boardgamegeek.com/xmlapi/search?search=".urlencode($nom);
                echo '<a href='. 'tuto_id_bgg.php' .' onclick="window.open(this.href); return false;"> ici</a>'; 
            ?>. (S'ouvre sur un différent onglet)<br />
            Si tu as la flemme de rentrer l'adresse pour trouver l'ID BoardGameGeek, clique sur ce
            <?php 
                $directory = "https://www.boardgamegeek.com/xmlapi/search?search=".urlencode($nom);
                echo '<a href='. $directory .' onclick="window.open(this.href); return false;"> lien</a>'; 
            ?>. (S'ouvre sur un différent onglet)<br /><br />

	        <form action = "index.php?id_page=203" method="post" >        	
        		<input type="text" name="ID" id="ID" placeholder="ID BGG" size="40" maxlength="60"/> <br />
        		<?php 
    	    		echo '<input type="hidden" name="echec" id="echec" value=' . $nom .'>'; 
	        	?>
        		<input type="submit" value="Valider" style="padding:4px 8px;"/>
    		</form>
    		</p>
    	</div>
    	<br/>
        <div>
            <p>
            <form action = "index.php?id_page=203.php" method="post" >
            Si tu as mal tapé le nom ou que le lien plus haut ne te renvoie pas vers le jeu que tu veux, 
            <label for="nom0">retape le nom du jeu ici :</label>
            <input type="text" name="nom0" id="nom0" placeholder="Ex : Gaïa" size="40" maxlength="60"/> <br />
            <input type="submit" value="Valider" style="padding:4px 8px;"/>
            </form>
            </p>
        </div>
        <br/>
        <div>
            <p>
            <form action = "index.php?id_page=203.php" method="post" >
            Si le temps de chargement a été long, cela peut-être dût à BoardGameGeek et je te conseil de tout rentrer à la main.<br />
            De même, si tu retournes sans arrêt sur cette page, je te conseil de tout rentrer à la main.<br />
            <input type="submit" value="Tout rentrer à la main" style="padding:4px 8px;" name = "bypass"/>
            </form>
            </p>
        </div>

    </div>
</div>