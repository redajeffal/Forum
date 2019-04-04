<?php
	class Modele_usagers extends BaseDAO
	{
		public function getTableName()
		{
			return "usagers";
		}
        
        public function getClePrimaire()
        {
            return "username";
        }
        
		// Obtenir les usagers via le username
		public function obtenirParId($username)
		{
			$resultat= $this->lire($username); //BaseDAO.php
            foreach($resultat as $rangee)
			{	
				$lesUsagers[] =array('username'=>$rangee["username"],'password'=>$rangee["password"],'banni'=>$rangee["banni"],'admin'=>$rangee["admin"]);		
			}
			if (isset($lesUsagers))
            {
                return $lesUsagers;                    
            }
		}
		
		// Obtenir la liste de tous les usagers
		public function obtenir_tous()
		{
			$resultat = $this->lireTous(); //BaseDAO.php
			foreach($resultat as $rangee)
			{
				$lesUsagers[] = new usager ($rangee["username"],$rangee["nom"],$rangee["prenom"], $rangee["password"], $rangee["admin"],  $rangee["banni"]);
			}
			if (isset($lesUsagers)) return $lesUsagers;
		}
		
		// Permettre la mise-a-jour des droits d'accês des usagers. (Bannir).
		public function updateUsager($usager, $valeur)
		{
			$query ="UPDATE ". $this->getTableName() . " SET banni=$valeur WHERE username = ?";	
			$donnees = array($usager);
			return $this->requete($query, $donnees);
		}	
	}
?>
