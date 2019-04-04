<?php
	class sujet
	{
		private $idSujet;
		private $titre;
		private $texte;
		private $dateCreation;
        private $User;
		
		public function __construct($s = 0, $ti = "", $te = "", $d = "", $u = "")
		{
			$this->idSujet = $s;
			$this->titre = $ti;
			$this->texte = $te;
            $this->dateCreation = $d;
			$this->User = $u;
		}
        
		public function getIdSujet()
		{
			return $this->idSujet;
		}
        
		public function setIdSujet($s)
		{
			if(is_numeric($s) && $s >= 0)
				$this->idSujet = $s;
			else
				trigger_error("Id sujet invalide.", E_USER_NOTICE);
		}
        
		public function getTitre()
		{
			return $this->titre;
		}
        
		public function setTitre($ti)
		{
			if(trim($ti)!="" && is_string($ti) && !is_numeric($ti))
				$this->titre = $ti;
			else
				trigger_error("Titre invalide.", E_USER_NOTICE);
		}
        
		public function getTexte()
		{
			return $this->texte;
		}
        
		public function setTexte($te)
		{
			if(trim($te)!="" && is_string($te))
				$this->texte = $te;
			else
				trigger_error("Texte invalide.", E_USER_NOTICE);
		}
        
		public function getDateCreation()
		{
			return $this->dateCreation;
		}
        
		public function setDateCreation($d)
		{
			if(trim($d)!="" && is_string($d))
				$this->dateCreation = $d;
			else
				trigger_error("Date de creation invalide.", E_USER_NOTICE);
		}
        
		public function getUser()
		{
			return $this->User;
		}
        
		public function setUser($u)
		{
			if(is_string($u) && trim($u)!="")
				$this->User = $u;
			else
				trigger_error("User invalide.", E_USER_NOTICE);
		}
	}
?>

