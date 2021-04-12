<?php

/*classe permettant de representer les tuples de la table client */
class Client 
{
	/*avec PDO, il faut que les noms attributs soient les mÃªmes que ceux de la table*/
	private $ncli;
	private $nom;
	private $ville;

	/* Les mÃ©thodes qui commencent par __ sont des methodes magiques */
	/* Elles sont appelÃ©es automatiquement par php suite Ã  certains Ã©vÃ©nements. */
	/* Ici c'est l'appel Ã  new sur la classe qui dÃ©clenche l'exÃ©cution de la mÃ©thode */
	/* des valeurs par dÃ©faut doivent Ãªtre spÃ©cifiÃ©es pour les paramÃ¨tres du constructeur sinon
		 il y aura une erreur lorsqu'il sera appelÃ© automatiquement par PDO 
	 */    
	
	public function __construct($i=-1,$n="", $v="") 
	{
		$this->ncli = $i;
		$this->nom = $n;
		$this->ville = $v;
	}

	public function getIdcli() { return $this->ncli; }
	public function getNom() { return $this->nom;}
	public function getVille() { return $this->ville; }

	public function __toString() 
	{
		$res = "idcli:".$this->ncli."\n";
		$res = $res ."nom:".$this->nom."\n";
		$res = $res ."ville:".$this->ville."\n";
		$res = $res ."<br/>";
		return $res;
	}
}

//test
//$unclient = new Client(5,'Dupont','Le Havre');
//echo $unclient;
?>