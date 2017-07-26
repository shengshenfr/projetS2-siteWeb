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

<div class="page"> <!--Corps de page-->

<!--détail-actualitee-->  
    <div class="portfolio">
        <div class="bdr-bottom-none">
            <div class="content article">
                <h2><?php echo $actualite['titre']; ?></h2> <!--Titre de l'article-->
                <div class="date"><?php echo $actualite['date']; ?></div> <!--Date de l'article-->
                <img src="<?php echo $chemin_images . $actualite['image']; ?>" alt="C'était pour faire joli :'(" width="100%" height="100%"/>
                <br/><br/>
                <p>
                    <?php echo $actualite['contenu']; ?> <!--Contenu de l'article-->
                </p>
            </div>
            <!--Si l'utilisateur est un administrateur-->
            <?php
                if($estAdmin){
            ?>

            <input type="button" value="Modifier" onclick="Modifier();" style="padding:4px 8px;" />
            <input type="button" value="Supprimer" onclick="Supprimer();" style="padding:4px 8px;" />
            <script type="text/javascript"> 
                var id_actualite = '<?php echo $actualite['id_actualite']; ?>' ;
                function Modifier() {
                    document.location.href="index.php?id_page=102&id_actualite="+id_actualite;
                }
                function Supprimer(){ 
                    if (confirm("Voulez-vous supprimer ? (Attention, ceci supprimera définitivement l'actualité et les images liées)")){ 
                        document.location.href="actualite/supprimer_actualiteC.php?id_actualite="+id_actualite; 
                    }
                } 
            </script> 
            <br/>
            <?php
                }
            ?>
            <br/>
            <a href="index.php?id_page=100">Retour</a>
                        
        </div>
    </div>
<!--détail-actualite-end-->
<div class="clearing"></div> 
</div> <!--Fin du corps de page-->