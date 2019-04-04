<?php
	class usager
	{
		private $username;
		private $nom;
		private $prenom;
		private $password;
		private $admin;
		private $banni;

		public function __construct($u = "", $n = "", $pr = "", $pa = "", $a = 0, $b = 0)
		{
			$this->username = $u;
			$this->nom = $n;
			$this->prenom = $pr;
			$this->password = $pa;
			$this->admin = $a;
			$this->banni = $b;
		}
        
		public function getUsername()
		{
			return $this->username;
		}
        
		public function setUsername($u)
		{
			if(trim($u)!="" && is_string($u))
				$this->username = $u;
			else
				trigger_error("Username invalide.", E_USER_NOTICE);
		}
        
		public function getNom()
		{
			return $this->nom;
		}
        
		public function setNom($n)
		{
			if(trim($n)!="" && is_string($n))
				$this->nom = $n;
			else
				trigger_error("Nom invalide.", E_USER_NOTICE);
		}
        
		public function getPrenom()
		{
			return $this->prenom;
		}
        
		public function setPrenom($pr)
		{
			if(trim($pr)!="" && is_string($pr))
				$this->prenom = $pr;
			else
				trigger_error("Prenom invalide.", E_USER_NOTICE);
		}
        
		public function getPassword()
		{
			return $this->password;
		}
        
		public function setPassword($pa)
		{
			if(trim($pa)!="" && is_string($pa))
				$this->password = $pa;
			else
				trigger_error("Password invalide.", E_USER_NOTICE);
		}
		
		public function getAdmin()
		{
			return $this->admin;
		}
        
		public function setAdmin($a)
		{
			if(is_numeric($a) && $a >= 0)
				$this->admin = $a;
			else
				trigger_error("admin invalide.", E_USER_NOTICE);
		}
        
		public function getBanni()
		{
			return $this->banni;
		}
        
		public function setBanni($b)
		{
			if(is_numeric($b) && $b >= 0)
				$this->banni = $b;
			else
				trigger_error("banni invalide.", E_USER_NOTICE);
		}

	}
?>

