<!-- 
    Cette vue affiche la liste des réponses pour un sujet selectionné par l'usager. 
    Ce dernier peut y ajouter une nouvelle réponse.
-->

    <div class="connexion">
    <?php if (isset($_SESSION["username"])) 
    {	
		echo '<a href="index.php?Accueil&action=deconnexion"><img src="images/bouton-logout.png" width="40px" height="40px"> </a>';
	    echo "<h1>Tp PHP :  Reda Jeffal et  Sylvain Pelletier</h1>";
		echo '<a href="index.php"><img src="images/home.png" width="40px" height="40px"></a>';
    }
    ?>
    </div>
	<div class="datagrid">
 	    <div>
        <?php
    		foreach($data['sujets'] as $valeur=>$sujet)
    		{ 
    			echo "<h2>" . $sujet->getTitre() . "</h2>";
    			echo "<p>" . $sujet->getTexte() . "</p>";
    			echo "<strong>Cr&eacutee par: " . $sujet->getUser() . "</strong>";
    			echo "<strong><p>En date du: " . $sujet->getDateCreation() . "</p></strong>";
            }?>
		</div>
        <table class="datagrid">
            <thead>
                <tr>
                    <th scope="col">R&eacute;ponses</th>
                    <th scope="col">De</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i=0;
            if (isset($data["reponses"]))
            {
                foreach($data['reponses'] as $valeurRep=>$reponse)
                {					
            ?>	
                <tr <?php if ($i % 2==0) echo 'class="ligne-impaire"'; else echo 'class="ligne-paire"';?> >
                    <td><strong><?= $reponse->getTitre(); ?></strong><br><?= $reponse->getTexte(); ?></td>
                    <td><?= $reponse->getUser() ; ?><br>en date du :
                    <?= $reponse->getDateCreation(); ?>
                    </td>
                </tr>
            <?php
            $i++;
                }
            }
            ?>
            </tbody>
        </table>
    </div>
	<form method="post">
        <fieldset>
            <div>                     
                <p><textarea class="form-reponse" name="texte" placeholder="ins&eacute;rer une r&eacute;ponse au sujet ici."></textarea></p>
            </div>
            <div >
                 <input type="hidden" name="username" value="<?php echo $_SESSION["username"];?>">
				<input type="hidden" name="titre" value="<?php echo  $sujet->getTitre(); ?>">
				<input type="hidden" name="action" value="insereRep">
				 <input type="hidden" name="idSujet" value="<?php echo $sujet->getIdSujet();?>">
                <input type="submit" class="btn btn-success" value="Enregistrer">
            </div>
        </fieldset>
    </form>
	
	