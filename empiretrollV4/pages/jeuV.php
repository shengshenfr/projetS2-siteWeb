<!--vue-->

<div class="page">
  <div class="portfolio">
	<div class="title">
      	<h1><?php echo '<div align="center"><h3>'.$res_jeu[0]['nom'].'</h3></div>';?></h1>
      	<br/><br/>
	</div>

		<table>
			<tr>
				<th><h3>Designer</h3></th>
				<th><h3>Langue</h3></th>
				<th><h3>Date de parution</h3></th>
				<th><h3>Nb min de joueurs</h3></th>
				<th><h3>Nb max de joueurs</h3></th>
				<th><h3>Durée</h3></th>
				<th><h3>Extension</h3></th>
			</tr>

			<tr>
				<td><?php echo '<h3>'.$res_jeu[0]['designer'].'</h3>';?></td>
				<td><?php echo '<h3>'.$res_jeu[0]['langue'].'</h3>';?></td>
				<td><?php echo '<h3>'.$res_jeu[0]['datum'].'</h3>';?></td>
				<td><?php echo '<h3>'.$res_jeu[0]['min_joueur'].'</h3>';?></td>
				<td><?php echo '<h3>'.$res_jeu[0]['max_joueur'].'</h3>';?></td>
				<td><?php echo '<h3>'.$res_jeu[0]['duree'].'</h3>';?></td>
				<td><?php 
						if ($res_jeu[0]['extension'] == 0){
							$extension = 'Non';
						}
						else{
							$extension = 'Oui';
						}
						echo '<h3>'.$extension.'</h3>';?></td>
			</tr>
		</table>
		<br/>
		<br/>

		<table>
			<tr>
				<th><h3>Image</h3></th>
				<th><h3>Editeur</h3></th>
				<th><h3>Genre(s)</h3></th>
				<th><h3>Complexite</h3></th>
				<th><h3>Etat</h3></th>
				<th><h3>Dégradation</h3></th>
			</tr>

			<tr>
				<td><?php echo '<input type="image" src="' .  $res_jeu[0]['image'] .'" name="image" width="200">';?></td>
				<td><?php echo '<h3>'. code_name($res_editeur[0]['editeur'],1).'</h3>';?></td>
				<td>
					<?php
						foreach($res_genre as $genre) {
							echo '<h3>'.code_name($genre,1).'</h3></div>';
						}
					?>
				</td>
				<td><?php echo '<h3>'.$res_jeu[0]['complexite'].'</h3>';?></td>
				<td><?php echo '<h3>'.code_name($res_jeu[0]['etat'],1).'</h3>';?>
				<?php if($estAdmin){ ?><br />
					<form method="post">
						<label for="etat">Changer l'état?</label><br/><br />
			            <select name="etat" id="etat" >
			            	<option selected disabled>Ne rien changer</option>
            			    <option value="Disponible">Disponible</option>
			                <option value="Emprunt_demandé">Emprunt demandé</option>
        		    	    <option value="Emprunté">Emprunté</option>
		        	        <option value="Non_Empruntable">Non Empruntable</option>
            			</select><br /><br/>
						<input type="hidden" name="id" value = <?php echo $id; ?> >
        				<input type="submit" value="Valider" style="padding:4px 8px;"/>
					</form>
					<?php } ?>
				</td>
				<td><?php echo '<h3>'.code_name($res_jeu[0]['degradation'],1).'</h3>';?>
					<?php if($estAdmin){ ?><br />
					<form method="post">
						<label for="degradation">Changer la dégradation?</label><br />
            			<select name="degradation" id="degradation">
            				<option selected disabled>Ne rien changer</option>
                		<?php
		            	    $degradations = array('Neuf','Bon_Etat','Moyen','Mauvais_Etat','Abimé');
        				    for ($i = 0; $i < count($degradations); $i++){
    	            			$degradation= code_name($degradations[$i],1);
	                			echo '<option value='.$degradations[$i]. '>'.$degradation.'</option>';
                			}
            	    	?>
			            </select><br /><br/>
						<input type="hidden" name="id" value = <?php echo $id; ?> >
        				<input type="submit" value="Valider" style="padding:4px 8px;"/>
					</form>
					<?php } ?>
				</td>
			</tr>
		</table>

		<?php if($estMembre){ ?>
		<table>
			<tr>
				<th><h3>Actions</h3></th>
			</tr>
			<tr>
				<td>
					<form action="" method="post">
				<?php if($estAdmin){ ?>
						<input type="hidden" name="modif" id="modif" value = <?php echo $id; ?> >
        				<input type="submit" name="modification" value="Modifier le Jeu" style="padding:4px 8px;"/>
						<input type="hidden" name="suppr" id="suppr" value = <?php echo $id; ?> >
        				<input type="submit" name="suppression" value="Supprimer le Jeu" style="padding:4px 8px;"/>
				<?php } ?> 
						<input type="hidden" name="emprunt_m" id="emprunt_m" value = <?php echo $id; ?> >
        				<input type="submit" value="Emprunter le Jeu" style="padding:4px 8px;"/>
        				<input type="hidden" name="proposition" id="emprunt" value = <?php echo $id; ?> >
        				<input type="submit" value="Proposer une Partie" style="padding:4px 8px;"/>
					</form>
				</td>
			</tr>
		</table>
		<?php } ?>

		<?php if(!$estMembre){ ?>
		<table>
			<tr>
				<th><h3>Action</h3></th>
			</tr>
			<tr>
				<td>
					<form action="" method="post">
						<input type="hidden" name="emprunt" id="emprunt_m" value = <?php echo $id; ?> >
        				<input type="submit" value="Emprunter le Jeu" style="padding:4px 8px;"/>
			        </form>
				</td>
			</tr>
		</table>
		<?php } ?>		

		<br/>
		<br/>
		<h2>Commentaires</h2>

		<table>
			<tr>
				
				<th><h3>pseudo</h3></th>
				<th><h3>commentaire</h3></th>
			</tr>

			<tr>
				<td>
					<?php
        				if(empty($res_commentaire[0]['pseudo'])) { 
           					echo '<h3>'."Aucun pseudo".'</h3>';
            			} else { 
        					echo '<h3>'.$res_commentaire[0]['pseudo'].'</h3>';
            			}
					?>
				</td>
				<td>
					<?php 
    					if(empty($res_commentaire[0]['commentaire'])) { 
           					echo '<h3>'."Aucun commentaire".'</h3>';
            			} else { 
            				echo '<h3>'.$res_commentaire[0]['commentaire'].'</h3>';
						}
					?>
				</td>
			</tr>
		</table>

		<br/>
		<br/>
		<a href="index.php?id_page=201">Retour</a>

	</div>
</div>