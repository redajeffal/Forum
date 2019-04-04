<!--
    Cette vue affiche la liste des sujets lorsque l'usager se connecte avec succès
    Si l'usager est admin, il peut gèrer les usagers et supprimer un sujet.
    Tout usager pouvant connecter au site, peut créer un sujet, consulter les sujets et répondre à n'importe quel sujet.
-->

<div class="connexion">
	<?php if (isset($_SESSION["username"])) 
        {	
	       		echo '<a href="index.php?Accueil&action=deconnexion"><img src="images/bouton-logout.png" width="40px" height="40px"></a>';
	        	echo "<h1>Tp PHP :  Reda Jeffal et  Sylvain Pelletier</h1>";
				echo '<a href="index.php"><img src="images/home.png" width="40px" height="40px"</a>';
        }
        ?>
</div>
<div class="accueil">
	<h2>Liste des sujets</h2>
	<?php
        // ʴablir permission d'administration du site ࡬'usager identifi顡dmin.
        $admin = false;
        if (isset($_SESSION["admin"]))
        {
            if (($_SESSION["admin"]==1) )
            {
                $admin = true;
                echo '		
                <form method="POST">
                    <fieldset>
                        <div>
                             <input name="action" value="gestionAdmin" type="hidden">
                             <input type="submit" class="btn btn-success" value="Gestion des usagers">
                        </div>
                    </fieldset>
                </form>';
            }
        }
        ?>
		<form method="POST">
			<fieldset>
				<div>
					<div>
						<input name="action" value="formAjouterSujet" type="hidden">
						<input type="submit" class="btn btn-success" value="Nouveau Sujet">
					</div>
				</div>
			</fieldset>
		</form>
</div>
<div class="datagrid">
	<table class="datagrid">
		<thead>
			<tr>
				<th scope="col">SUJETS</th>
				<th scope="col">Dernieres Reponses</th>
				<?php if($admin) echo '<th></th>' ?>
			</tr>
		</thead>
		<tbody>
			<?php
			$i=0;
			if (isset($data["sujets"]))
			{
				foreach($data["sujets"] as $sujet=> $value)
				{
            ?>
				<tr <?php if ($i % 2==0) echo 'class="ligne-impaire"'; else echo 'class="ligne-paire"';?> >
					<td><a href="index.php?Reponses&action=afficherReponses&idSujet=<?= $value['idSujet'] ?>"><strong><?= $value['titre'] ?></strong></a><br>cree par :
						<?= $value["User"] ?><br>le :
							<?= $value['dateCreationSujet'] ?>
					</td>
					<td>De:
						<?= $value['userRep'] ?><br>le :
							<?= $value['dateCreationReponse'] ?><br>Nombre :
								<?= $value['nbRep'] ?>
					</td>
					<?php
                        if($admin)
                        {
                            echo '<td>
                            <form method="POST">
                                <div>
                                    <input  name="action" value="supprimerSujet"  type="hidden">
                                    <input  name="idSujet" value="' . $value['idSujet'] . '" type="hidden">
                                    <input " type="submit" class="btn btn-primary" value="Supprimer">
                                </div>
                             </form>
                            </td>';
                        }  
				        ?>
				</tr>
				<?php
					$i++;
				}
			}
            ?>
		</tbody>
	</table>
</div>
