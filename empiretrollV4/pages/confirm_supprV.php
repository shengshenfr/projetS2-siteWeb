<!--vue-->

<div class="page">
  <div class="portfolio">
  		<div class="title">
			<h1>Suppression d'un jeu</h1>
			<br/>
		</div>

			<h2>Confirmation de la suppression</h2>

		<p>
			Vous allez supprimer le jeu <?php echo $jeu[0]['nom']; ?>.
		<br/> <form method="post" >
		<label for="suppr">Êtes-vous sûr de vouloir supprimer ce jeu ? <br />
			Cette action est irrémédiable</label>
		<br />
		<input type="hidden" name="id" value = <?php echo $id; ?> >
		<input type="submit" name="confirm_suppr" value="Oui" style="padding:4px 8px;"/>
		<input type="submit" name="cancel" value="Non" style="padding:4px 8px;"/>
		</form>
		</p>
	</div>
</div>