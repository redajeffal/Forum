<?php
	class Controleur_Reponses extends BaseControleur
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
                    // sp_Afficher la page HTML des réponses associées au sujet sélectionné
                    // dans la vue AfficheListeReponses.
					case "afficherReponses":
						if(isset($params["idSujet"]))
						{
							$modeleSujets = $this->getDAO("sujets"); //BaseControleur.php
							$data['sujets'] = $modeleSujets->obtenirParId($params["idSujet"]); // Modele_sujets.php
							
							$modeleReponses = $this->getDAO("reponses"); //BaseControleur.php
							$data['reponses'] = $modeleReponses->obtenirParId($params["idSujet"]); // Modele_reponses.php
							$this->afficheVue("header");
							$this->afficheVue("AfficheListeReponses", $data);
							$this->afficheVue("footer");
							$_SESSION["idSujet"]=$params["idSujet"];
						}
						else
						{
							trigger_error("Pas d'idSujet spécifié...");
						}
						break;
                        
					case "SupprRep":
						
						if(isset($params["id"]) && Trim($params["id"])<>"" && is_numeric(trim($params["id"])))
						{
							
								$modeleSujets = $this->getDAO("Sujets");
								
								$modeleSujets->supprime($params["id"]);
								$this->afficheListeReponses();
								
						}
						else
						{
							echo "<br/>identifiant du sujet a supprimer non valide!";
						}
						
						
						break;	
					///////////////////////////////////////////////Fin case suppression sujet//////////////////////////////	
					case "insereRep" :
						if(isset($params["texte"]) && isset($params["idSujet"]) && isset($params["username"]) )
						{
							if($params["texte"] !=""){
							$erreurs = $this->valideFormReponse($params["texte"]);
							//s'il n'y a pas d'erreurs
							if($erreurs == "")
							{
								
								$modeleReponses = $this->getDAO("reponses");
								$nouveauReponse = new reponse(0,$params["titre"], $params["texte"],date("Y-m-d H:i:s"), $params["username"], $params["idSujet"]);
									
		
								
								$succes = $modeleReponses->sauvegarde($nouveauReponse);
								if($succes)
								{	
									$this->afficheListeReponses();
								}
								else
								{
									$this->afficheAjoutReponse();
								}
							}
							else
							{
								$this->afficheAjoutReponse($erreurs);
							}
						}
							else{
								$this->afficheListeReponses();
							}
						}
					else
					{
							$this->afficheAjoutReponse();
					}
						break;
						trigger_error("Action invalide.");		
				}
			}
			else
			{
				//action par défaut - afficher la page ou on peut se connecter et voir la liste des sujets
				$this->afficheListeReponses();
			}
		}

		private function afficheListeReponses()
		{
			$modeleSujets = $this->getDAO("sujets");
			$data['sujets'] = $modeleSujets->obtenirParId($_SESSION["idSujet"]);
			
			$modeleReponses = $this->getDAO("reponses");
			$data["reponses"] = $modeleReponses->obtenirParId($_GET["idSujet"]);
			$this->afficheVue("header");
			$this->afficheVue("AfficheListeReponses", $data);
			$this->afficheVue("footer");
		}

		private function afficheAjoutReponse($erreur = "")
		{
			$modeleReponses = $this->getDAO("reponses");
			$data["reponses"] = $modeleReponses->obtenir_tous();
			$data["erreurs"] = $erreur;
			$this->afficheVue("header");
			$this->afficheVue("AfficheListeReponses", $data);
			$this->afficheVue("footer");
		}
	
		private function valideFormReponse($texte)
		{
			$erreur = "";
			$texte = trim($texte);
			
			if($texte == "")
				$erreur .= "Le texte ne peut être vide.<br>";
						 
			return $erreur;
		}
	}
?>