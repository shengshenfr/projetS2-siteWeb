<div class="page">
  <div class="portfolio">
		<div class="title">
            <h1>Ajout d'un jeu</h1>
            <br/>
        </div>

        <h2>Deuxième étape: Rentrer les informations à la main</h2>

        <p>
        <form action = "index.php?id_page=203" method="post" > 
        <label for="nom">Rentrer le nom :</label>
        <input type="text" name="nom" id="nom" placeholder="Ex :Gaïa" size="40" maxlength="60" required/>
        </p>


        <p>
        <label for="designer">Rentrer l'auteur :</label>
        <input type="text" name="designer" id="designer" placeholder="Ex :Rorik Traversal" size="40" maxlength="60" required/>
        </p>


        <p>
        <label for="nb_joueur">Rentrer le nombre de joueur :</label>
        <input type="number" name="min_joueur" min="1" max="6" required>
        <input type="number" name="max_joueur" min="1" max="20" required>
        </p>

        <p>
        <label for="duree">Rentrer le temps de jeu :</label>
        <input type="number" name="duree" min="5" max="500" step="5" required>
        </p>


        <p>
        <label for="image">Rentrer l'image :</label>
        <input type="text" name="image" id="image" placeholder="Ex ://cf.geekdo-images.com/images/pic1215982.jpg" size="40" maxlength="150" required/>
        </p>

        <br />
        <input type="hidden" name="jump" id="jump" value = "TRUE" >
        <input type="submit" value="Valider" style="padding:4px 8px;"/>
    	</form>

    </div>
</div>