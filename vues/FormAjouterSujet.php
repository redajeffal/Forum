
    <div class="connexion">
        <?php if (isset($_SESSION["username"])) 
              {	
               		echo '<a href="index.php?Accueil&action=deconnexion"><img src="images/bouton-logout.png" width="40px" height="40px"></a>';
	 				echo "<h1>Tp PHP :  Reda Jeffal et  Sylvain Pelletier</h1>";
					echo '<a href="index.php"><img src="images/home.png" width="40px" height="40px"> </a>';
              }
        ?>
    </div>
	<h1>Ajoutez un sujet</h1>
    <form method="POST">
        <fieldset>
            <legend>[ Ajouter un sujet ]</legend>
            <div>
                Titre: <input id="textinput" name="titre" placeholder="Entrer un titre" type="text" />
            </div>
            <div>
                Texte: <textarea id="textarea" name="texte" placeholder="Entrer un texte descriptif du sujet"></textarea>
            </div>
            <div>
                <input type="hidden" name="action" value="ajouterSujet">
                <input type="submit" class="btn btn-success" value="Enregistrer">
            </div>
        </fieldset>
    </form>
	