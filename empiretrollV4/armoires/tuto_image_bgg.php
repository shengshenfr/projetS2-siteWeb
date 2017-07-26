<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Trouver unu image</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
        
    <body>
    	<h1>Tutoriel: Trouver la bonne image d'un jeu sur BoardGameGeek</h1>
		<p>
			Le plus simple est de passer par BoardGameGeek pour trouver l'image.<br />
      		Tu peux cliquer sur ce
			<?php 
        	    $directory = "https://boardgamegeek.com";
            	echo '<a href='. $directory .' onclick="window.open(this.href); return false;"> lien</a>'; 
	        ?> qui te menera sur boardgamegeek si tu veux. (S'ouvre sur un différent onglet)<br />
	        Cherche ton jeu sur le site.<br />
	        Attention, les images des boites sont souvent différentes de la boite française donc n'ignore pas un jeu dont l'image n'est pas exactement celle de ton jeu.<br />
	        Lorsque tu as trouvé ton jeu, tu dois être sur une page comme cela :<br />
	        <img src="tuto10.png" height="352" width="550" > <br /><br />
	        Descend la page jusqu'à arriver sur un cadre appelé "Version" et cherche ta version selon la langue (ici, j'ai choisi "english"):<br />
	        <img src="tuto20.png" height="352" width="550" > <br /><br />
	        Quand tu as trouvé la version que tu veux, clique sur l'image pour en avoir une version aggrandit.<br />
	        Il te suffit alors de faire un clique droit sur l'image, puis de l'afficher<br />
	        Tu as alors dans ta barre d'url l'url de l'image, et il te suffit de le rajouter !
	    </p>
	</body>
</html>