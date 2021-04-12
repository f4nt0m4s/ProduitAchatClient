<?php

	/**
		* Classe Utilisateur
	*/
	class Utilisateur 
	{
		
		public $nom;
		public $pwd;
		public $droitAcces;

		/* Les méthodes qui commencent par __ sont des methodes magiques */
		/* Elles sont appelées automatiquement par php suite à certains événements. */
		/* Ici c'est l'appel à new sur la classe qui déclenche l'exécution de la méthode */
		/* des valeurs par défaut doivent être spécifiées pour les paramètres du constructeur sinon
			 il y aura une erreur lorsqu'il sera appelé automatiquement par PDO 
		 */    
		
		public function __construct($n="",$p="",$d=-1) 
		{
			$this->nom = $n;
			$this->pwd = $p;
			$this->droitAcces = $d;
		}

		public function getNom()
		{ 
			return $this->nom; 
		}
		
		public function getPwd() 
		{ 
			return $this->pwd;
		}

		public function getDroitAcces()
		{
			return $this->droitAcces;
		}

		public function __toString()
		{
			$res = "nom:".$this->nom."\n";
			$res = $res ."pwd:".$this->pwd."\n";
			$res = $res ."droitAcces:".$this->droitAcces."\n";
			$res = $res ."<br/>";
			return $res; 
		}
	}

//test
//$unutilisateur= new Utilisateur('test1','pwdtest2', 1);
//echo $unutilisateur;
?>