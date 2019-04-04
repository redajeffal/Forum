<?php
	class Modele_reponses extends BaseDAO
	{
		public function getTableName()
		{
			return "reponses";
		}
        
        public function getClePrimaire()
        {
            return "idSujet";
        }

		// Obtenir les reponses par id du sujet
		public function obtenirParId($id)
		{
			$query = "SELECT * from reponses WHERE idSujet=? order by dateCreation ";
			
			$donnees = array($id);
			$resultat = $this->requete($query, $donnees);
			foreach($resultat as $rangee)
			{
				$lesreponses[] = new reponse ($rangee["idReponse"], $rangee["titre"], $rangee["texte"],$rangee["dateCreation"],$rangee["User"], $rangee["idSujet"]);
 			}
			if (isset($lesreponses)) return $lesreponses;
		}
		
		// Inserer une réponse pour un sujet sélectionné
		public function sauvegarde(reponse $laReponse)
		{
            $query = "INSERT INTO " . $this->getTableName() . "(titre, texte, dateCreation, User, idSujet) VALUES (?, ?, ?, ?, ?)";
            $donnees = array($laReponse->getTitre(), $laReponse->getTexte(), $laReponse->getDateCreation(), $laReponse->getUser(), $laReponse->getIdSujet());
            return $this->requete($query, $donnees);
		}
		
        // Supprimer les réponses associées à un sujet supprimé.
		public function supprimer($id)
		{
			$query = "DELETE FROM reponses WHERE idSujet=?";
			$donnees = array($id);
			return $this->requete($query, $donnees);
		}
	}
?>