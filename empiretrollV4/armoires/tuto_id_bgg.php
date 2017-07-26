<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Trouver l'ID BoardGameGeek</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
        
    <body>

		<h1>Tutoriel: Trouver l'ID BoardGameGeek d'un jeu</h1>
		<p>

			Salut ! Tu cherches l'ID BoardGameGeek d'un jeu sans même savoir ce que c'est ?<br />
			Sache que cette ID est l'identifiant du jeu dans la base de données de BoardGameGeek, pour le trouver c'est pas bien difficile ! <br /><br />

			Commence par aller sur ce 
			<?php 
        	    $directory = "https://www.boardgamegeek.com/xmlapi/search?search=NomàRechercher";
            	echo '<a href='. $directory .' onclick="window.open(this.href); return false;"> lien</a>'; 
	        ?>. (S'ouvre sur un différent onglet)<br />
    	    Tu remarqueras l'url finit par "NomàRechercher", remplace donc cela par le nom du jeu que tu cherches. <br />
        	Tu es alors sur une page ressemblant normalement à cela et il te suffit de trouver ton jeu et puis son ID BoardGameGeek: <br />
        	<img src="tuto01.png" height="352" width="470" > <br /><br />
    	</p>
        <h2>Problèmes communs</h2>
        <h3>Aide 1: Je trouve pas mon jeu sur le lien que tu m'as passé !</h3>
        <p>
      		Le plus simple dans ce cas est de passer par BoardGameGeek pour trouver l'ID BoardGameGeek.<br />
      		Tu peux cliquer sur ce
			<?php 
        	    $directory = "https://boardgamegeek.com";
            	echo '<a href='. $directory .' onclick="window.open(this.href); return false;"> lien</a>'; 
	        ?> qui te menera sur boardgamegeek si tu veux. (S'ouvre sur un différent onglet)<br />
	        Cherche ton jeu sur le site, si plusieurs jeux ont un nom identiques, passe à l'aide suivante<br />
	        Sinon, quand tu as trouvé ton jeu, si tu es sur la page d'informations générales du jeu, tu remarques un chiffres dans l'url: C'est l'ID BoardGameGeek de ce jeu. <br />
	    </p>
      	<h3>Aide 2: Plusieurs jeux ont le même nom, je prends lequel ?</h3>
      	<p>
      		Tu arrives sur une page avec plusieurs noms de jeux identiques et tu ne sais pas comment savoir si c'est bien ton jeu ?<br />
      		Le plus simple est de passer par BoardGameGeek pour trouver l'ID BoardGameGeek.<br />
      		Tu peux cliquer sur ce
			<?php 
        	    $directory = "https://boardgamegeek.com";
            	echo '<a href='. $directory .' onclick="window.open(this.href); return false;"> lien</a>'; 
	        ?> qui te menera sur boardgamegeek si tu veux. (S'ouvre sur un différent onglet)<br />
	        Cherche ton jeu sur le site.<br />
	        Attention, les images des boites sont souvent différentes de la boite française donc n'ignore pas un jeu dont l'image n'est pas exactement celle de ton jeu.<br />
	        Lorsque tu as trouvé ton jeu, si tu es sur la page d'informations générales du jeu, tu remarques un chiffres dans l'url: C'est l'ID BoardGameGeek de ce jeu. <br />
	    </p>
	    <h3>Aide 3: Je trouve pas mon jeu sur boardgamegeek</h3>
      	<p>
      		Cela peut être dut à deux choses. <br />
      		Soit BoardGameGeek ont un problème sur leur site et il te faudra attendre pour trouver l'ID de ton jeu.<br />
      		Pour savoir si c'est le cas, cherche d'autres jeu, si tu ne les trouves pas, tu es bien dans ce cas-là<br />
      		Soit le jeu n'est pas sur BoardGameGeek.<br />
	      	Dans ce cas-là, si tu étais en train de rentrer un jeu, tu vas devoir rentrer toutes les informations à la main.<br />
	      	Attention pour l'image, évite de faire des choses illégales tout de même.<br />
	      	Clique donc ici pour passer directement à l'étape deux du formulaire. <br />
	      	<form action = "index.php" method="post" >
	      	<input type="submit" value="Passer à l'étape 2" name ="bypass"/>
	      	</form>
	    

	</body>
</html>