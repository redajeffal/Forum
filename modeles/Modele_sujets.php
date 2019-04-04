<?php
	class Modele_sujets extends BaseDAO
	{
		public function getTableName()
		{
			return "sujets";
		}
		
        public function getClePrimaire()
        {
            return "idSujet";
        }
        
		// Obtenir un sujet via son id
		public function obtenirParId($id)
		{
			$resultat = $this->lire($id);
			
			foreach($resultat as $rangee)
			{
				$lesSujets[] = new sujet ($rangee["idSujet"],$rangee["titre"],$rangee["texte"], $rangee["dateCreation"], $rangee["User"]);
			}
			return $lesSujets;
		}
		
		// Obtenir la liste des sujets avec la derniere réponse postée et le nombre de réponses associées
		public function lireTous()
		{
			$query="SELECT sujets.titre, count(reponses.texte) AS nbRep, max(reponses.dateCreation) AS dateCreationReponse, reponses.idSujet as reponseSujetId, sujets.idSujet as sujetID, sujets.User,
			sujets.dateCreation as dateCreationSujet, reponses.User as userRep 
                    FROM sujets 
                    LEFT JOIN reponses ON reponses.idSujet = sujets.idSujet 
				    GROUP BY sujetID ORDER BY dateCreationReponse DESC";
			
			$resultat = $this->requete($query);
			
			foreach($resultat as $rangee)
			{
				$lesSujets[] = array('idSujet'=>$rangee["sujetID"],'titre'=>$rangee["titre"],'User'=>$rangee["User"], 'dateCreationSujet'=>$rangee["dateCreationSujet"],'userRep'=>$rangee["userRep"], 'dateCreationReponse'=>$rangee["dateCreationReponse"], 'nbRep'=>$rangee["nbRep"]);
			}
			if (isset($lesSujets)) return $lesSujets;
		}

		// Ajouter un sujet
		public function sauvegarde(Sujet $leSujet)
		{
            $query = "INSERT INTO " . $this->getTableName() . "(titre, texte, dateCreation, User) VALUES (?, ?, ?, ?)";
            $donnees = array($leSujet->getTitre(), $leSujet->getTexte(), $leSujet->getDateCreation(), $leSujet->getUser());
            return $this->requete($query, $donnees);
		}

        // Supprimer un sujet
		public function supprime($id)
		{
			if($this->lire($id)->fetch()) //BaseDAO.php
			{
				$this->supprimer($id);
				
			}
		}
	}
?>