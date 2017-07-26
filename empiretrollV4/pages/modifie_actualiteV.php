<!--vue-->

<!--donnees du controleur

$actualite : tableau contenant l'actualite
structure : ['titre' : str,
    'date' : str,
    'contenu' : str,
    'id' : int]

$estMembre : bool

$estAdmin : bool
-->

<div class="page  mar-top30"> <!--Corps de page-->

<!--modifier-->
    <div class="primary-col">
        <div class="generic bdr-bottom-none">
            <div class=" panel">
                <div class="title">
                    <h1>Modifier l'actualité</h1>
                </div>

                <div class="content"> 
                    <form method="post" action="actualite/modifie_actualite_postC.php" enctype="multipart/form-data">
                        <label for="titre">Titre</label><br/>
                        <input type="text" name="titre" id="titre" value="<?php echo $actualite['titre']; ?>" /> <!--Préremplie le formulaire avec le titre actuel-->
                        <br/>
                        <label for="contenu">Texte</label><br/>
                        <textarea name="contenu" id="contenu" rows="10" cols="70"><?php echo $actualite['contenu']; ?></textarea> <!--Préremplie le formulaire avec le contenu actuel-->
                        <br/>
                        <br/>
                        <input name="id_actualite" type="number" value="<?php echo $actualite['id_actualite']; ?>" hidden="hidden"/>
                        <input name="id_image" type="number" value="<?php echo $actualite['id_image']; ?>" hidden="hidden"/>
                        <fieldset>
                            <legend>Modifier l'image</legend>
                            <?php
                                foreach($images_defaut as $cle => $elt){
                            ?>
                            <input type="radio" name="image" value="<?php echo $elt['id']; ?>" id="<?php echo $elt['nom']; ?>" <?php if($elt['id'] == $actualite['id_image']){echo 'checked';} ?> />
                            <label for="<?php echo $elt['nom']; ?>"><img src="<?php echo $chemin_images . 'miniature_' . $elt['nom']; ?>" alt="image"/></label><br/>
                            <?php
                                }
                            ?>
                            <?php
                                if($actualite['image_supprimable']){
                            ?>
                            <input type="radio" name="image" value="<?php echo $actualite['id_image']; ?>" id="<?php echo $actualite['image']; ?>" checked />
                            <label for="<?php echo $actualite['image']; ?>"><img src="<?php echo $chemin_images . 'miniature_' . $actualite['image']; ?>" alt="image"/></label><br/>
                            <?php
                                }
                            ?>
                            <input type="radio" name="image" value="nouvelle image" id="nouvelle image"/>
                            <label for="nouvelle image"><input type="file" name="image_chargee"/></label>
                        </fieldset>
                        <br/>
                        <input type="submit" value="Valider" style="padding:4px 8px;"/>
                        <input type="button" value="Supprimer" onclick="Supprimer();" style="padding:4px 8px;" />
                        <script type="text/javascript"> 
                            var id_actualite = '<?php echo $actualite['id_actualite']; ?>' ;
                            function Supprimer(){ 
                                if (confirm("Voulez-vous supprimer ? (Attention, ceci supprimera définitivement l'actualité et les images liées)")){ 
                                    document.location.href="actualite/supprimer_actualiteC.php?id_actualite="+id_actualite; 
                                }
                            } 
                        </script> 
                    </form>
                
                <br/>
                <a href="index.php?id_page=101&amp;id_actualite=<?php echo $actualite['id_actualite']; ?>">Retour</a>
                </div>

            </div>
        </div>
    </div>
<!--modifier-end-->

    <div class="clearing"></div>
</div> <!--Fin du corps de page-->