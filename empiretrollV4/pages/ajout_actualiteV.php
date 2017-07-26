<!--vue-->

<!--donnees du controleur

$estMembre : bool

$estAdmin : bool
-->

<div class="page  mar-top30"> <!--Corps de page-->

<!--ajout-->
    <div class="primary-col">
        <div class="generic bdr-bottom-none">
            <div class=" panel">
                <div class="title">
                    <h1>Nouvelle actualité</h1>
                </div>
    
                <div class="content"> 
                    <form method="post" action="actualite/ajout_actualite_postC.php">
                        <label for="titre">Titre</label><br/>
                        <input type="text" name="titre" id="titre" autofocus required /><br/> <!--Formulaire pour renter le titre-->
                        <label for="contenu">Texte</label><br/>
                        <textarea name="contenu" id="contenu" rows="10" cols="70"></textarea> <!--Formulaire pour rentrer le texte-->
                        <fieldset>
                            <legend>Ajouter une image</legend>
                            <?php
                                foreach($images_defaut as $cle => $elt){
                            ?>
                            <input type="radio" name="image" value="<?php echo $elt['id']; ?>" id="<?php echo $elt['nom']; ?>" />
                            <label for="<?php echo $elt['nom']; ?>"><img src="<?php echo $chemin_images . 'miniature_' . $elt['nom']; ?>" alt="image1"/></label><br/>
                            <?php
                                }
                            ?>
                            <input type="radio" name="image" value="nouvelle image" id="nouvelle image" checked/>
                            <label for="nouvelle image"><input type="file" name="image_chargee"/></label>
                        </fieldset>
                        <br/>
                        <input type="submit" value="Valider" style="padding:4px 8px;"/>
                    </form>
                    <br/>
                    <a href="index.php?id_page=100">Retour</a>
                </div>

            </div>
        </div>
    </div>
    <!--ajout-end-->
    <div class="clearing"></div>
</div> <!--Fin du corps de page-->
