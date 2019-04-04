<?php
    SESSION_start();
	abstract class BaseControleur
	{		
		// Méthode générale de traitement qui sera appelée par le routeur.
		public abstract function traite(array $params);
        
        // Déterminer la vue à afficher et quel modèle à charger.
		protected function afficheVue($nomVue, $data = null)
		{
            // Le paramètre data est utilisé directement dans les vues
			$cheminVue = RACINE . "vues/" . $nomVue . ".php";

			if(file_exists($cheminVue))
			{
				include_once($cheminVue);
			}
			else
			{
				trigger_error("Erreur 404! La vue $cheminVue n'existe pas!");
			}
		}

		protected function getDAO($nomModele)
		{
			$classe = "Modele_" . $nomModele;

			if(class_exists($classe))
			{
				// Connexion à la base de données
				$connexionPDO = DBFactory::getDB(DBTYPE, DBNAME, HOST, USERNAME, PWD);

				// Création d'une instance de la classe Modele_$nomModele				
				$objetModele = new $classe($connexionPDO);
                
				if($objetModele instanceof BaseDAO)
				{
					return $objetModele;
				}
				else
				{
					trigger_error("Le modèle est invalide.");
				}
			}
		}
	}
?>