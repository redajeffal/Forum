<!--
 Cette vue affiche la liste des usagers qui peut accéder au site.
 L'usager administrateur peut faire la maintenance du site tel que 
 supprimer un sujet, bannir un usager.-->

    <div class="connexion">

    <?php if (isset($_SESSION["username"])) 
    {	
				echo '<a href="index.php?Accueil&action=deconnexion"><img src="images/bouton-logout.png" width="40px" height="40px"></a>';
				echo "<h1>Tp PHP :  Reda Jeffal et  Sylvain Pelletier</h1>";
				echo '<a href="index.php"><img src="images/home.png" width="40px" height="40px"></a>';
    }
    ?>
    </div>
    <div class="container">
    <h2>La liste des usagers du Forum</h2>
        <?php
        if (isset($_SESSION["admin"]))
        {
            if($_SESSION["admin"]==1)
            {	
        ?>	
                <div class="datagrid">          
                <?php
                $i=0;
                if (isset($data["usagers"]))
                {
                    echo '<table class="datagrid">
					<thead><tr><th scope="col">USERNAME</th><th scope="col">NOM</th><th>PRENOM</th><th>BANNIR</th><th>STATUT</th></tr></thead><tbody>';
                    foreach($data["usagers"] as $usager=> $value)
                    {
                ?>	
                        <tr <?php if ($i % 2==0) echo 'class="ligne-impaire"'; else echo 'class="ligne-paire"';?> >
                        <td><p><?=$value->getUsername(); ?></p></td><td><p><?= $value->getNom(); ?></p></td><td><p><?= $value->getPrenom(); ?></p></td>
                        <td>
                            <form method="POST">
                            <?php if ($value->getBanni()==1){?>
                            <div>
                                <input type="hidden" name="username" value="<?=$value->getUsername() ?>"/><br>
                                <input type="hidden" name="valeur" value="0"/><br>
									<input type="hidden" name="action" value="bannirUsager"/><br>
									<input class="btn btn-primary" type="submit" value="Autoriser"/><br>
								
                            </div>
                            <?php
                            }
                            else
                            {
                            ?>	
                            <div>
                                <input type="hidden" name="username" value="<?=$value->getUsername() ?>"/><br>
                                <input type="hidden" name="valeur" value="1"/><br>
								<?php if ($value->getUsername()!=$_SESSION["username"]){?>
									<input type="hidden" name="action" value="bannirUsager"/><br>
									<input type="submit" class="btn btn-primary" value="Bannir"/><br>
								<?php
                            	}
								?>
                            </div>
                            <?php
                            }
                            ?>
                            </form>
                        </td>
                        <?php
                            if ($value->getBanni()==1) echo "<td ><p>Banni</p></td>";
                            else echo "<td><p>Autoris&eacute</p></td>";
                        ?>
                        </tr>
                        <?php
                            $i++;
                    }
					echo " </table>";
                    ?>
                  
                   
                <?php 
                }
                ?>
           
        <?php 
        }
        }
        ?>

    </div>
   	
