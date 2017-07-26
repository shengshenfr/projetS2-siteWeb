<div class="page">
  <div class="portfolio">
        <div class="title">
            <h1>Modifier un jeu</h1>
            <br/>
        </div>

            <h2>Les valeurs actuelles sont rentrées</h2>

        <br/> <form action = "" method="post" >
        <fieldset>
            <legend>Informations sur le jeu</legend>
                <label for="nom">Modifier le nom :</label>
                    <input type="text" name="nom" id="nom" placeholder="<?php echo $jeu['nom']; ?>" size="40" maxlength="60"/><br/><br/>
                 
                <label for="designer">Modifier l'auteur :</label>
                    <input type="text" name="designer" id="designer" placeholder= "<?php echo $jeu['designer']; ?>" size="40" maxlength="60"/><br/><br/>
                 
                <label for="nb_joueur">Modifier le nombre de joueur :</label>
                    <input type="number" name="min_joueur" min="1" max="6" placeholder= "<?php echo $jeu['min_joueur']; ?>">
                    <input type="number" name="max_joueur" min="1" max="20" placeholder= "<?php echo $jeu['max_joueur']; ?>"><br/><br/>
                 
                <label for="duree">Modifier le temps de jeu :</label>
                    <input type="number" name="duree" min="5" max="500" step="5" placeholder="<?php echo $jeu['duree']; ?>"><br/><br/>
                      
                <?php echo '<img src="' .$jeu['image'].'" name="image" width="200">';?>
                <label for="image">Modifier l'image :</label>
                    <input type="text" name="image" id="image" size="40" maxlength="80" placeholder="<?php echo $jeu['image'] ?>"/><br/><br/>
                Si tu ne sais pas où trouver l'image que tu veux sur BoardGameGeek, on a un tutoriel
                <?php 
                    $directory = "https://www.boardgamegeek.com/xmlapi/search?search=".urlencode($jeu['nom']);
                    echo '<a href='. 'armoires/tuto_image_bgg.php' .' onclick="window.open(this.href); return false;"> ici</a>'; 
                ?>. (S'ouvre sur un différent onglet)<br />
                 
                <label for="editeur">Qui l'édite ?</label><br/>
                    <select name="editeur" id="editeur">
                        <option selected disabled><?php echo code_name(get_editeur($jeu['id_editeur'])[0]['editeur'],1); ?></option>
                    <?php
                        for ($i = 0; $i < count($editeurs); $i++){
                            $editeur= code_name($editeurs[$i][0],1);
                            echo '<option value='.$editeurs[$i][0]. '>'.$editeur.'</option>';
                        }
                    ?>
                    </select><br /><br />
                 
                 <label for="addEditeur">Pas trouvé l'éditeur ? Ajoute-le !</label><br />
                    <input type="text" name="addEditeur" id="addEditeur" placeholder="Ajoute ton éditeur" size="20" maxlength="15" /><br /><br />
                 
                <label for="datum">Date de parution ?</label><br />
                    <input type="text" name="datum" id="datum" placeholder="<?php echo $jeu['datum'] ?>" size="10" maxlength="4" /><br /><br />
                 
                Est-ce une extension ?<br />
                    <input type="radio" name="extension" value="1" id="1" <?php if($jeu['extension'] == 1){echo "checked";} ?>/> <label for="0">oui</label>
                    <input type="radio" name="extension" value="0" id="0" <?php if($jeu['extension'] == 0){echo "checked";} ?>/> <label for="1">non</label><br /><br />
                 
                <label for="genre">C'est quel(s) genre(s) ?</label><br />
                    <select name="genre[]" multiple default required>
                    <?php
                        foreach($genre as $g){
                            echo "<option selected disabled> $g </option>";
                        }
                        for ($i = 0; $i < count($genres); $i++){
                            $genre= code_name($genres[$i],1);
                            echo '<option value='.$genres[$i]. '>'. $genre .' </option>';
                        }
                    ?>
                        <option value=" ">Aucun de ceux-là</option>
                </select><br /><br />
                 
                <label for="addGenre">Pas trouvé un genre ? Ajoute-le !</label><br />
                    <input type="text" name="addGenre0" id="addGenre0" placeholder="Ajoute ton genre" size="20" maxlength="15" />
                    <input type="text" name="addGenre1" id="addGenre1" placeholder="Ajoute ton genre" size="20" maxlength="15" />
                    <input type="text" name="addGenre2" id="addGenre2" placeholder="Ajoute ton genre" size="20" maxlength="15" /><br /><br />  
                 
                <label for="complexite">Quel est sa complexité ?</label><br/>
                    <select name="complexite" id="complexite" >
                        <option selected disabled><?php echo code_name($jeu['complexite'],1); ?></option>
                        <option value="Très Facile">Très Facile</option>
                        <option value="Facile">Facile</option>
                        <option value="Modérée">Modérée</option>
                        <option value="Difficile">Difficile</option>
                        <option value="Très Difficile">Très Difficile</option>
                        <option value="Hardcore">Hardcore</option>
                    </select>
        </fieldset>
        <br />
        <fieldset>
            <legend>Informations sur la boite</legend>
                <label for="degradation">Quel est son état ?</label><br />
                    <select name="degradation" id="degradation">
                        <option selected disabled><?php echo code_name($jeu['degradation'],1); ?></option>
                        <?php
                            $degradations = array('Neuf','Bon Etat','Moyen','Mauvais Etat','Abimé');
                            for ($i = 0; $i < count($degradations); $i++){
                                $degradation= code_name($degradations[$i],1);
                                echo '<option value='.$degradations[$i]. '>'.$degradation.'</option>';
                            }
                        ?>
                    </select><br /><br/>
                 
                <label for="langue">Quelle(s) est(sont) la(les) langue(s) du jeu ?</label><br />
                    <select name="langue[]" multiple required>
                        <?php
                        foreach($langue as $lg){
                            echo "<option selected disabled> $lg </option>";
                        }
                        ?>
                        <option value="Anglais">Anglais</option>
                        <option value="Français">Français</option>
                        <option value="Allemand">Allemand</option>
                        <option value="Espagnol">Espagnol</option>
                        <option value="Arabe">Arabe</option>
                        <option value="Chinois">Chinois</option>
                        <option value="Japonais">Japonais</option>
                        <option value="Italien">Italien</option>
                        <option value="Russe">Russe</option>
                        <option value="Neerlandais">Neerlandais</option>
                        <option value="Portugais">Portugais</option>
                    </select><br /><br />
                
                <label for="pseudo">Il appartient à qui ?</label><br />
                    <select name="pseudo[]" default required>
                        <option selected disabled><?php echo $membre; ?></option>
                        <?php
                            for ($i = 0; $i < count($pseudos); $i++){
                                $pseudo= code_name($pseudos[$i],1);
                                echo '<option value='.$pseudos[$i]. '>'. $pseudo .'</option>';
                            }
                        ?>
                        <option value=" ">Aucun de ceux-là</option>
                    </select><br /><br />
        </fieldset>
        
        <input type="hidden" name="id" id="id" value = <?php echo $id; ?> >
        <input type="submit" name="modifV2" value="Modifier" style="padding:4px 8px;"/>
        <input type="submit" name="cancel" value="Annuler" style="padding:4px 8px;"/>

        </form>
        </p>

    </div>
</div>