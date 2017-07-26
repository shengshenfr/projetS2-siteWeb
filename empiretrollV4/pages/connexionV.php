<!--vue-->

<!--donnees du controleur

$estMembre : bool

$estAdmin : bool
-->

<div class="page"> <!--Corps de page-->

<!--ajout-->
    <div class="portfolio">
        <div class="title">
            <div class="title">
                <h1>Connexion</h1>
            </div>
            <br/>
            <div class="content">
                <?php
                    if(isset($_GET['erreur'])){
                        echo '<div class="error"> <img src="images/error.png" width="12px"/> ';
                        if($_GET['erreur']==1){
                            echo " Ce pseudo n'existe pas.";
                        } if($_GET['erreur']==2){
                            echo "Compte inactif ou mot de passe erroné.";
                        }
                        echo '</div><br/>';
                    }
                ?>
                <form method="post" action="connexion/connexion_post.php">
                    <label for="pseudo">Pseudo</label><br/>
                    <input type="text" name="pseudo" id="pseudo" autofocus required /><br/>
                    <label for="mdp">Mot de passe</label><br/>
                    <input type="password" name="mdp" id="mdp" autofocus required /><br/>
                    <br/>
                    <input type="submit" value="Valider"/>
                </form>
                <br/>
                <a href="index.php">Retour</a>
            </div>
        </div>
    </div>
<!--ajout-end-->
    <div class="clearing"></div>
</div> <!--Fin du corps de page-->