<?php
	//déclaration de la racine du projet
	define("RACINE", $_SERVER["DOCUMENT_ROOT"] . "/TP2-FORUM-MVC/");

	//définition des constantes de connexion à la base de données
	define("DBNAME", "e1895078");     //base de données dont les tables et le data de départ créé via forumDB
    //define("DBNAME", "e1895039");   
	define("DBTYPE", "mysql");
    define("HOST", "localhost");
    define("USERNAME", "e1895078");
    //define("USERNAME", "e1895039");
	define("PWD", "a00V5eDKjV7Qsl6osQo8");
    //define("PWD", "p4PMNigBF4JLfwPZHRE8");

    // Activer le chargement automatique des classes
	function mon_autoloader($classe)
	{
		$repertoires = array(RACINE . "controleurs/", 
				             RACINE . "modeles/",
				             RACINE . "vues/"
        );

		foreach($repertoires as $rep)
		{
			if(file_exists($rep . $classe . ".php"))
			{
				require_once($rep . $classe . ".php");
				return;
			}
		}
	}

    // Enregistre une fonction en tant qu'implémentation de __autoload()
    // ce qui permet d'éviter les spécifications include/require
    spl_autoload_register("mon_autoloader");
?>