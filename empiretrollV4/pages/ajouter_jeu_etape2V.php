<div class="page">
  <div class="portfolio">
        <div class="title">
            <h1>Ajout d'un jeu</h1>
            <br/>
        </div>

        <h2>Deuxième étape: Vérifier les informations trouvées</h2>

        <p> Le jeu a bien été rajouté, et on est allé chercher ces informations sur BoardGameGeek, tu peux vérifier si elles sont bonnes ?</p>
        <br/>

        <ul>

        <li>
        <form action = "index.php?id_page=203" method="post" > 
        <label for="nom">Modifier le nom :</label>
        <input type="text" name="nom" id="nom" placeholder="<?php echo $nom; ?>" size="40" maxlength="60"/>
        </li>

        <li>
        <label for="designer">Modifier l'auteur :</label>
        <input type="text" name="designer" id="designer" placeholder= "<?php echo $designer; ?>" size="40" maxlength="60"/>
        </li>

        <li>
        <label for="nb_joueur">Modifier le nombre de joueur :</label>
        <input type="number" name="min_joueur" min="1" max="6" placeholder= "<?php echo $min_joueur; ?>">
        <input type="number" name="max_joueur" min="1" max="20" placeholder= "<?php echo $max_joueur; ?>">
        </li>

        <li>
        <label for="duree">Modifier le temps de jeu :</label>
        <input type="number" name="duree" min="5" max="500" step="5" placeholder="<?php echo $duree; ?>">
        </li>

        <li>
            <?php echo '<img src="' .$image.'" name="image" width="200">';?><br/>
        <label for="image">Modifier l'image :</label>
        <input type="text" name="image" id="image" size="40" maxlength="80" placeholder="<?php echo $image ?>"/><br/>
        Si tu ne sais pas où trouver l'image que tu veux sur BoardGameGeek, on a un tutoriel
        <?php 
            $directory = "https://www.boardgamegeek.com/xmlapi/search?search=".urlencode($nom);
            echo '<a href='. 'armoires/tuto_image_bgg.php' .' onclick="window.open(this.href); return false;"> ici</a>'; 
        ?>. (S'ouvre sur un différent onglet)<br />
        </li>

        <ul>

        <br />
        <input type="hidden" name="reussite" id="reussite" value = <?php echo $nom; ?> >
        <input type="submit" value="Valider" style="padding:4px 8px;"/>
        </form>
    </div>
</div>