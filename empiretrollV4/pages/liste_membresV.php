<!--vue-->

<!--donnees du controleur

$liste_membres : tableau des membres
structure : [['id' : int,
    'pseudo' : str,
    'mail' : str,
    'actif' : int
    'admin' : int]]

-->

<!--informations
En mode administrateur il est possible d'activer un compte et de rendre un utilisateur administrateur.
En mode Grand Administrateur il est possible de désactiver un compte et de déchoir un administrateur de son statut.
-->

<div class="page"> <!--Corps de page-->

<!--list des membres-->
    <div class="portfolio">
        <div class="title">
            <h1>Liste des membres</h1>
        </div>
        <br/>

        <div class="content">
                    
            <table>
                <!--Ligne d'entête du tableau-->
                <tr>
                    <th>id</th>
                    <th>Pseudo</th>
                    <th>Mail</th>
                    <th>Compte actif</th>
                    <th>Administrateur</th>
                    <th>Changer statut</th>
                    <?php if($idMembre==1){ ?>
                    <th>Déchoir</th>
                    <?php } ?>
                </tr>
                <!--Début boucle pour chaque membre dans la liste-->
                <?php
                    foreach($liste_membres as $cle => $membre){
                ?>
                <tr>
                    <td><?php echo $membre['id']; ?></td>
                    <td><?php echo $membre['pseudo']; ?></td>
                    <td><?php echo $membre['mail']; ?></td>
                    <td><?php
                        if($membre['actif']==1){
                            echo "<div class='oui'>Oui</div>";
                        } else {
                            echo "<div class='non'>Non</div>";
                        }?></td>
                    <td><?php
                        if($membre['admin']==1){
                            echo "<div class='oui'>Oui</div>";
                        } else {
                            echo "<div class='non'>Non</div>";
                        }?></td>
                    <td>
                        <?php if($membre['id']!=1){?> <!--Désactive les possibilité de modifier le statut du Grand Administrateur-->
                        <form method="post" action="connexion/liste_membres_post.php">
                            <input type='hidden' name='membreid' value=<?php echo $membre['id']?>>
                            <input type="checkbox" name="activer" id="activer" /> <label for="activer">Activer</label><br/>
                            <input type="checkbox" name="admin" id="admin" /> <label for="admin">Rendre admin</label><br/>
                            <input type="submit" value="Enregistrer"/>
                        </form>
                        <?php } ?>
                    </td>
                    <?php if($idMembre==1){ ?> <!--Si l'utilisateur est le Grand Administrateur-->
                    <td>
                        <?php if($membre['id']!=1){?> <!--Désactive les possibilité de modifier le statut du Grand Administrateur-->
                        <form method="post" action="connexion/liste_membres_post.php">
                            <input type='hidden' name='membreid' value=<?php echo $membre['id']?>>
                            <input type="checkbox" name="desactiver" id="desactiver" /> <label for="desactiverr">Désactiver</label><br/>
                            <input type="checkbox" name="desadmin" id="desadmin" /> <label for="desadmin">Rendre membre</label><br/>
                            <input type="submit" value="Enregistrer"/>
                        </form>
                        <?php } ?>
                    </td>
                            
                    <?php } ?>
                </tr>
                <?php
                    }
                ?>
            </table>
            <!--Fin boucle-->

            <br/>
                    
            <br/>
            <a href="index.php">Retour</a>
        </div>
    </div>
<!--liste des membres-end-->

<div class="clearing"></div>
</div> <!--Fin du corps de page-->