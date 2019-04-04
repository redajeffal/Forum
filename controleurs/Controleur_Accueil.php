<?php
 
	class Controleur_Accueil extends BaseControleur
	{		
		public function traite(array $params)
		{
			// Si le paramètre action existe
			if(isset($params["action"]))
			{
				// Switch en fonction de l'action qui nous est envoyée
				// Switch pour déterminer la vue et obtenir le modèle
				switch($params["action"])
				{
					// sp_Afficher la page d'accueil (liste de sujets) dans la vue AfficheListeSujets.
					case "accueil":
						$this->afficheAccueil();
						break;
    
                    // sp_Ouverture de session pour usager autorisé et chaînage dans la vue AfficheListeSujets.
                    // Usager banni, reçoit un message approprié et demeure dans la vue AfficheLogin.
					case "connexion":
						if(isset($params["username"]) && isset($params["password"]))
						{
							if($params["username"] != "" && $params["password"] != "" )
							{
								$modeleUsagers = $this->getDAO("usagers"); //BaseControleur.php
								$donnees["usagers"] = $modeleUsagers->obtenirParId($params["username"]); // Modele_sujets.php
								if ($donnees["usagers"] != [])   
								{
									foreach($donnees["usagers"] as $usager=> $value)
									{
										if ($value['password']==$params['password'])
										{
											if ($value['banni']==0)
											{			
												$_SESSION["username"]=$value['username'];
												$_SESSION["password"]=$value['password'];
												$_SESSION["banni"]=$value['banni'];
												$_SESSION["admin"]=$value['admin'];
												
												$this->afficheAccueil();
											}
											else
											{
												$this->afficheVue("header");
												$this->afficheLogin();
												echo "Désolé " . $value["username"] . "! Vous n'êtes pas autorisé à entrer sur le site, veuillez contacter l'administrateur.";
												$this->afficheVue("footer");
											}
										}
										else 
										{
											$this->afficheVue("header");
                                            $this->afficheLogin();
											echo "Désolé! Votre mot de passe est erroné!";
											$this->afficheVue("footer");
										}
									}
								} 
								else 
								{
									$this->afficheVue("header");
									$this->afficheLogin();
                                    echo "Désolé! Votre username et mot de passe sont erronnés. Essayez à nouveau ou contacter l'administarteur.";
									$this->afficheVue("footer");
								}
							}
						}
						break;
						
					// sp_Fermeture de session. Retourne dans la vue AfficheLogin.
					case "deconnexion":
						if (ini_get("session.use_cookies")) 
						{
                            $params = session_get_cookie_params();
				            setcookie(session_name(), '', time() - 42000,$params["path"], $params["domain"], $params["secure"], $params["httponly"]);
						}
						session_destroy();
						header("location: index.php");
                        break;
                        
					// sp_Supprimer un sujet et les réponses respectives.
                    // Demeure dans la vue AfficheListeSujets avec mise à jour.
					case "supprimerSujet":
						if((isset($params["idSujet"])) && (Trim($params["idSujet"])<>"") && (is_numeric(trim($params["idSujet"]))))
						{
//							$modeleReponses = $this->getDAO("reponses"); //BaseControleur.php
//							$modeleReponses->supprimer($params["id"]);
                            $modeleReponse=$this->getDAO("reponses");
							$modeleReponse->supprimer($params["idSujet"]);
							$modeleSujets = $this->getDAO("sujets"); //BaseControleur.php
  							$modeleSujets->supprime($params["idSujet"]); //Modele_sujets.php
							$this->afficheAccueil();
						}
						else
						{
							echo "<br/>Le sujet a supprimer est invalide!";
						}
						break;
                        
                        
					// sp_Formulaire d'insertion d'un sujet.
					case "formAjouterSujet":
						$this->afficheAjoutSujet();
						break;
					
					// sp_Insérer un sujet à la base de données.					
					case "ajouterSujet" :				
						if(isset($params["titre"]) && isset($params["texte"]) && isset($_SESSION["username"]))
						{
                            // sp_S'assurer la présence d'un titre et un texte adéquat.
							$erreurs = $this->valideFormSujet($params["titre"], $params["texte"]);
							if($erreurs == "")
							{
								$modeleSujets = $this->getDAO("sujets"); //BaseControleur.php
								if (!isset($params["id"]))
								{ 
									$nouveauSujet = new sujet(0, $params["titre"], $params["texte"], date("Y-m-d H:i:s"), $_SESSION["username"]);
								}
								else 
								{
									$nouveauSujet = new Sujet($params["id"], $params["titre"], $params["texte"], date("Y-m-d H:i:s"), $_SESSION["username"]);
								}
								$succes = $modeleSujets->sauvegarde($nouveauSujet); //Modele_sujets.php
								if($succes)
								{
									$this->afficheAccueil();
								}
								else
								{
									$this->afficheAjoutSujet();	
								}
							}
							else
							{
								$this->afficheAjoutSujet($erreurs);
								
							}
						}
						else
						{
							$this->afficheAccueil();
							
						}
						break;	
					
					// sp_Gestion des usagers et sujets du site par l'administrateur
					case "gestionAdmin":
						if (isset($_SESSION["admin"]) &&($_SESSION["admin"]==1) )
						{
							$modeleUsagers = $this->getDAO("usagers"); //BaseControleur.php
							$donnees["usagers"] = $modeleUsagers->obtenir_tous(); //Modeles_usagers.php
							$this->afficheVue("header");
							$this->afficheVue("AfficheListeUsagers",$donnees);
							$this->afficheVue("footer");
						}
						else
                        {
                            $this->afficheAccueil();
                        }
						break;
					
					// sp_Bannir un usager ou l'autoriser au site
					case "bannirUsager":
						if(isset($_SESSION["admin"]) &&($_SESSION["admin"]==1) && isset($params["username"]) && isset($params["valeur"]))
						{
							$modeleUsagers = $this->getDAO("usagers"); //BaseControleur.php
							$donnees["usagers"] = $modeleUsagers->updateUsager($params["username"],$params["valeur"]); //Modele_usagers.php
							$donnees["usagers"] = $modeleUsagers->obtenir_tous(); //Modele_usagers.php
							$this->afficheVue("header");
							$this->afficheVue("AfficheListeUsagers",  $donnees);
							$this->afficheVue("footer");
						}
						break;
					
					default:
						trigger_error("Action invalide.");
                        $this->afficheAccueil();
				}
			}
			else
			{
				// sp_Action du controleur à effectuer par défaut - afficher la page d'accueil.
				if(isset($_SESSION["username"]) && isset($_SESSION["password"]) && isset($_SESSION["banni"] ) && isset($_SESSION["admin"])  )
				{
					if ($_SESSION["banni"]==1)
					{
                        echo "Désolé " . $_SESSION["username"] . "! Vous n'êtes pas autorisé à entrer sur le site, veuillez contacter l'administrateur.";
						$this->afficheVue("header");
                        $this->afficheLogin();
						$this->afficheVue("footer");
						
                    }
				    else
                    {
                        $this->afficheAccueil();
					    
                    }
                }
				else
                {
                    // sp_Traitement initial à l'appel de l'application, aucune action spécifiée.
					$this->afficheVue("header");
                    $this->afficheLogin();
					$this->afficheVue("footer");
                }
			}
		}

        // sp_Afficher la page HTML d'authentification username et password (Login).
        // Identification du modèle mis en cause - usager.
		private function afficheLogin()
		{
			$modeleSujets = $this->getDAO("usagers"); //BaseControleur.php
			$this->afficheVue("AfficheLogin");
			
		}
		
        // sp_Afficher la page HTML d'accueil qui consiste à la liste des sujets du forum. 
        // Identifictation du modèle mis en cause - sujets.
		private function afficheAccueil()
		{
			$modeleSujets = $this->getDAO("sujets"); //BaseControleur.php
			$donnees["sujets"] = $modeleSujets->lireTous(); //BaseDAO.php
			$this->afficheVue("header");
			$this->afficheVue("AfficheListeSujets", $donnees);
			$this->afficheVue("footer");
		}

        // sp_Afficher la page HTML permettant d'ajouter une réponse contenant une entête et un texte.
		private function afficheAjoutSujet($erreurs = "")
		{
			$modeleSujets = $this->getDAO("sujets"); //BaseControleur.php
			$donnees["erreurs"] = $erreurs;
			$this->afficheVue("header");
			$this->afficheVue("FormAjouterSujet", $donnees);
			$this->afficheVue("footer");
		}
	
        // sp_S'assurer la présence d'un titre et un texte adéquat.
		private function valideFormSujet($titre, $texte)
		{
			$erreur = "";
			$titre = trim($titre);
			$texte = trim($texte);
			if($titre == "")
				$erreur .= "Le titre est requis!<br>";

			if(strlen($titre) > 250)
				$erreur .= "Le titre est limité à 250 caractères.";
			 
			if($texte == "")
				$erreur .= "Le texte est requis!<br>";

			return $erreur;
		}
	}
?>