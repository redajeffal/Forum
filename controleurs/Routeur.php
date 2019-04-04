<?php
	class Routeur
	{
		public static function route()
		{
			// Obtenir la chaine de la requête (ex : Sujets&action=liste)
			$queryString = $_SERVER["QUERY_STRING"];
			$posEperluette = strpos($queryString, "&");

            $controleur = "";   
            
            if($posEperluette === false)
            {
                $controleur = $queryString;
            }
            else
			{
				$controleur = substr($queryString, 0, $posEperluette);
            }
            
			// Si aucun controleur n'a été spécifié dans queryString, mettre un controleur par défaut
			if($controleur == "")
				$controleur = "Accueil";
            
			// Chercher la classe avec le nom du controleur
			$classe = "Controleur_" . $controleur;

            // Création d'une instance si la classe existe.
            if(class_exists($classe))
			{
				$objetControleur = new $classe;
				if($objetControleur instanceof BaseControleur)
					$objetControleur->traite($_REQUEST);
				else
					trigger_error("Controleur invalide.");
			}
			else
			{
				trigger_error("Erreur 404! Le controleur $classe n'existe pas.");
			}
		}
	}
?>