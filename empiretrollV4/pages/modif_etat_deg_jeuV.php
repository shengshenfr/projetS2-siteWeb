<div class="page">
  <div class="portfolio">
  		<div class="title">
			<h1>Modification d'un jeu</h1>
			<br/>
		</div>

			<h2>Confirmation de la modification</h2>

		<p>
		Vous allez modifier le jeu <?php echo $jeu[0]['nom']; ?>.
		<br/> <form method="post" >
		<label for="modif">Vous aller changer <?php echo $changement; ?> de <?php echo code_name($old_value,1); ?> à <?php echo code_name($new_value,1); ?></label>
		<br />
		<input type="hidden" name="id" value = <?php echo $id; ?> >
		<input type="hidden" name="column" value = <?php echo $column; ?> >
		<input type="hidden" name="new_value" value = <?php echo $new_value; ?> >
		<input type="submit" name="change" value="Confirmer" style="padding:4px 8px;"/>
		<input type="submit" name="cancel" value="Annuler" style="padding:4px 8px;"/>
		</form>
		</p>
	</div>
</div>