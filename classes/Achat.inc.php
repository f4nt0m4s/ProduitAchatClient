<?php

/*classe permettant de representer les tuples de la table achat */
class Achat 
{
	/*avec PDO, il faut que les noms attributs soient les mÃªmes que ceux de la table*/
	private $ncli;
	private $np;
	private $qa;

	/* Les méthodes qui commencent par __ sont des methodes magiques */
	/* Elles sont appelées automatiquement par php suite à  certains évenements. */
	/* Ici c'est l'appel à new sur la classe qui déclenche l'exécution de la méthode */
	/* des valeurs par défaut doivent être spécifiées pour les paramètres du constructeur sinon
		 il y aura une erreur lorsqu'il sera appelé automatiquement par PDO 
	 */    
	
	public function __construct($i=-1, $n=-1,$q=-1) 
	{
		$this->ncli = $i;
		$this->np = $n;
		$this->qa = $q;

	}

	public function getNcli() { return $this->ncli; }
	public function getNp() { return $this->np;}
	public function getQa() { return $this->qa; }

	public function __toString() 
	{
		$res = "ncli:".$this->ncli."\n";
		$res = $res ."numero produit:".$this->np."\n";
		$res = $res ."quantite achetee:".$this->qa."\n";
		$res = $res ."<br/>";
		return $res;
	}
}

//test
//$unAchat = new Achat(5, 1, 13);
//echo $unAchat;
?>