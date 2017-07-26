<!--vue-->

<!--donnees du controleur

$fil_actualites : tableau des actualites
structure : [['titre' : str,
    'date' : str,
    'contenu' : str,
    'id' : int]]

$estMembre : bool

$estAdmin : bool
-->



<div class="page  mar-top30"> <!--Corps de page-->

<!--side-bar-->
    <div class="side-bar">
        <div class="submenu">
            <div class="panel">
                <div class="title">
                    <h1>Archives</h1>
                </div>
                <div class="content">
                    <a href="index.php?id_page=100&amp;nbapp=<?php echo $nbapp; ?>&amp;numpage=<?php echo $numpage; ?>">
                        Toutes les actualites
                    </a><br/><br/>
                    <h3>Par années</h3>
                    <ul><?php
                        foreach($nb_actualites_annee as $elt){
                    ?>
                    <li>
                    <a href="index.php?id_page=100&amp;nbapp=<?php echo $nbapp; ?>&amp;numpage=<?php echo $numpage; ?>&amp;annee=<?php echo $elt['annee']; ?>">
                        annee <?php echo $elt['annee']; ?> (<?php echo $elt['nb']; ?>)
                    </a></li>
                    <?php
                        }
                    ?></ul><br/>

                    <h3>Par mois</h3>
                    <ul><?php
                            foreach($nb_actualites_mois as $elt){
                    ?>
                    <li>
                    <a href="index.php?id_page=100&amp;nbapp=<?php echo $nbapp; ?>&amp;numpage=<?php echo $numpage; ?>&amp;annee=<?php echo $elt['annee']; ?>&amp;mois=<?php echo $elt['mois']; ?>">
                        <?php echo $liste_mois[$elt['mois']-1] . ' - ' . $elt['annee']; ?> (<?php echo $elt['nb']; ?>)
                    </a></li>
                    <?php
                        }
                    ?></ul>
                </div>
            </div>
        </div>
    </div>
<!--side-bar-end-->

<!--fil-actualites-->
    <div class="primary-col">
        <div class="generic bdr-bottom-none">
            <div class=" panel">
                <div class="title">
                    <h1>Actualité</h1>
                    <h3  align="right">Nombre d'actualites par page</h3>
                    <div  class="numero" align="right">
                    <?php
                        foreach($tab_nbapp as $elt){
                    ?>
                    <a href="index.php?id_page=100&amp;nbapp=<?php echo $elt; ?>&amp;numpage=<?php echo $numpage; ?>&amp;annee=<?php echo $annee; ?>&amp;mois=<?php echo $mois; ?>">
                        <?php if($elt==$nbapp){echo '<span>';}?>
                        <?php echo $elt; ?>
                        <?php if($elt==$nbapp){echo '</span>';}?>&nbsp;&nbsp;&nbsp;
                    </a>
                    <?php
                        }
                    ?></div>
                    <br/><br/><br/>
                </div>
                        
                <!--Début boucle pour chaque actualité dans le fil-->
                <?php
                    foreach($fil_actualites as $cle => $actualite){
                ?>

                <div class="date"><?php echo $actualite['date']; ?></div> <!--Récupère la date-->
                <div class="content article">
                    <!--Lien vers le détail de l'article-->
                    <h2><a href="index.php?id_page=101&amp;id_actualite=<?php echo $actualite['id_actualite']; ?>"><?php echo $actualite['titre']; ?></a></h2> <!--Récupère le titre-->
                    <p>
                        <?php echo $actualite['contenu']; ?> <!--Récupère le contenu de l'article-->
                    </p>
                </div>
                <?php
                    }
                ?>
                <!--Fin boucle-->
                        
                <h3>Page</h3>
                    <div class="numero">
                    <?php
                        for($i = 0 ; $i * $nbapp < $nb_actualites ; $i ++){
                    ?>
                    <a href="index.php?id_page=100&amp;nbapp=<?php echo $nbapp; ?>&amp;numpage=<?php echo $i; ?>&amp;annee=<?php echo $annee; ?>&amp;mois=<?php echo $mois; ?>">
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
    </div>
    <!--fil-actualites-end-->
    <div class="clearing"></div>
</div> <!--Fin du corps de page-->
