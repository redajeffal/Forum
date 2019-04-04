<?php
	abstract class BaseDao
	{
		protected $db;

		public function __construct(PDO $dbPDO)
		{			
			$this->db = $dbPDO;
		}
			
		protected function supprimer($clePrimaire)
		{
			$query = "DELETE FROM " . $this->getTableName() . " WHERE " . $this->getClePrimaire() ."=?";
			$donnees = array($clePrimaire);
			return $this->requete($query, $donnees);
		}

		protected function lire($valeurCherchee, $clePrimaire = NULL)
		{
			if(!isset($clePrimaire)){
				$query = "SELECT * from " . $this->getTableName() . " WHERE " . $this->getClePrimaire() ."=?";
			}
			else{
				$query = "SELECT * from " . $this->getTableName() . " WHERE " . $clePrimaire ."=?";
			}
			$donnees = array($valeurCherchee);
			return $this->requete($query, $donnees);
		}

		protected function lireTous()
		{
			$query = "SELECT * from " . $this->getTableName();
			return $this->requete($query);
		}

		final protected function requete($query, $data = array())
		{
			try
			{
				$stmt = $this->db->prepare($query);
				$stmt->execute($data);
			}
			catch(PDOException $e)
			{
				trigger_error("<p>La requête suivante a donné une erreur : $query</p><p>Exception : " . $e->getMessage() . "</p>");
                return false;
			}
			return $stmt;
		}
		
		abstract protected function getClePrimaire();
		abstract function getTableName();	
	}
?>