<div class="page">
  <div class="portfolio">
        <div class="title">
            <h1>Ajout d'un jeu</h1>
            <br/>
        </div>

        <h2>Troisième étape: Rentrer les autres informations</h2>

        <br/> <form action = "index.php?id_page=203" method="post" >
        <fieldset>
            <legend>Information sur le jeu</legend>
            <label for="editeur">Qui l'édite ?</label><br/>
            <select name="editeur" id="editeur">
                <option selected disabled>Choisi parmi ceux-là</option>
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
            <input type="text" name="datum" id="datum" placeholder="Ex :2006" size="10" maxlength="4" /><br /><br />
                
            Est-ce une extension ?<br />
            <input type="radio" name="extension" value="1" id="1" /> <label for="0">oui</label>
            <input type="radio" name="extension" value="0" id="0" /> <label for="1">non</label><br /><br />
                
            <label for="genre">C'est quel(s) genre(s) ?</label><br />
            <select name="genre[]" multiple default required>
               <?php
                    for ($i = 0; $i < count($genres); $i++){
                    $genre= code_name($genres[$i],1);
                    echo '<option value='.$genres[$i]. '>'. $genre .'</option>';
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
                <option selected disabled>Choisi parmi ceux-là</option>
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
            <legend>Information sur la boite</legend>
            <label for="degradation">Quel est son état ?</label><br />
            <select name="degradation" id="degradation">
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
                <option selected disabled>Choisi parmi ceux-là</option>
               <?php
                    for ($i = 0; $i < count($pseudos); $i++){
                    $pseudo= code_name($pseudos[$i],1);
                    echo '<option value='.$pseudos[$i]. '>'. $pseudo .'</option>';
                    }
                ?>
                <option value=" ">Aucun de ceux-là</option>
            </select><br /><br />
        </fieldset>
        
        <input type="hidden" name="fin" id="fin" value = <?php echo $nom; ?> >
        <input type="submit" name ="quitter" value="Valider" style="padding:4px 8px;"/>
        <input type="submit" value="Valider et ajouter un autre jeu" style="padding:4px 8px;"/>

        </form>
        </p>

    </div>
</div>