<?php

require 'Client.inc.php';
require 'Achat.inc.php';
require 'Produit.inc.php';

class DB {
	private static $instance = null; //mémorisation de l'instance de DB pour appliquer le pattern Singleton
	private $connect=null; //connexion PDO à la base

	/************************************************************************/
	//	Constructeur gerant  la connexion à la base via PDO
	//	NB : il est non utilisable a l'exterieur de la classe DB
	/************************************************************************/	
	private function __construct() {
			// Connexion à la base de données

			$servername = "localhost";
			$username = "postgres";
			$password = "azerty123";
			$dbname = "postgres";
		
		try {
		  // Connexion à la base
			  $this->connect = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
		  // Configuration facultative de la connexion
		  $this->connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); 
		  $this->connect->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION); 
		}
		catch (PDOException $e) {
					echo "probleme de connexion :".$e->getMessage();
			return null;    
		}
	}

	/************************************************************************/
	//	Methode permettant d'obtenir un objet instance de DB
	//	NB : cet objet est unique pour l'exécution d'un même script PHP
	//	NB2: c'est une methode de classe.
	/************************************************************************/
	public static function getInstance() {
			 if (is_null(self::$instance)) {
		try { 
			self::$instance = new DB(); 
		} 
		catch (PDOException $e) {
			echo $e;
		}
		} //fin IF
		$obj = self::$instance;

		if (($obj->connect) == null) {
		 self::$instance=null;
		}
		return self::$instance;
	} //fin getInstance	 

	/************************************************************************/
	//	Methode permettant de fermer la connexion a la base de données
	/************************************************************************/
	public function close() {
			 $this->connect = null;
	}
	
	/************************************************************************/
	//	Methode uniquement utilisable dans les méthodes de la class DB 
	//	permettant d'exécuter n'importe quelle requête SQL
	//	et renvoyant en résultat les tuples renvoyés par la requête
	//	sous forme d'un tableau d'objets
	//	param1 : texte de la requête à exécuter (éventuellement paramétrée)
	//	param2 : tableau des valeurs permettant d'instancier les paramètres de la requête
	//	NB : si la requête n'est pas paramétrée alors ce paramètre doit valoir null.
	//	param3 : nom de la classe devant être utilisée pour créer les objets qui vont
	//	représenter les différents tuples.
	//	NB : cette classe doit avoir des attributs qui portent le même que les attributs
	//	de la requête exécutée.
	//	ATTENTION : il doit y avoir autant de ? dans le texte de la requête
	//	que d'éléments dans le tableau passé en second paramètre.
	//	NB : si la requête ne renvoie aucun tuple alors la fonction renvoie un tableau vide
	/************************************************************************/
	private function execQuery($requete,$tparam,$nomClasse) {
			 //on prépare la requête
		 $stmt = $this->connect->prepare($requete);
		 //on indique que l'on va récupére les tuples sous forme d'objets instance de Client
		 $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $nomClasse); 
		 //on exécute la requête
		 if ($tparam != null) {
		$stmt->execute($tparam);
		 }
		 else {
		$stmt->execute();
		 }
		 //récupération du résultat de la requête sous forme d'un tableau d'objets
		 $tab = array();
		 $tuple = $stmt->fetch(); //on récupère le premier tuple sous forme d'objet

		 if ($tuple) {
		//au moins un tuple a été renvoyé
			 while ($tuple != false) {
			 $tab[]=$tuple; //on ajoute l'objet en fin de tableau
				 $tuple = $stmt->fetch(); //on récupère un tuple sous la forme
						//d'un objet instance de la classe $nomClasse 
		 } //fin du while	           	     
		 }
		 return $tab;    
	}
  
	 /************************************************************************/
	//	Methode utilisable uniquement dans les méthodes de la classe DB
	//	permettant d'exécuter n'importe quel ordre SQL (update, delete ou insert)
	//	autre qu'une requête.
	//	Résultat : nombre de tuples affectés par l'exécution de l'ordre SQL
	//	param1 : texte de l'ordre SQL à exécuter (éventuellement paramétré)
	//	param2 : tableau des valeurs permettant d'instancier les paramètres de l'ordre SQL
	//	ATTENTION : il doit y avoir autant de ? dans le texte de la requête
	//	que d'éléments dans le tableau passé en second paramètre.
	/************************************************************************/
	private function execMaj($ordreSQL,$tparam) {
			 $stmt = $this->connect->prepare($ordreSQL);
		 $res = $stmt->execute($tparam); //execution de l'ordre SQL      	     
		 return $stmt->rowCount();
	}

	/*************************************************************************
	 * Fonctions qui peuvent être utilisées dans les scripts PHP
	 *************************************************************************/
	public function getClients() {
			$requete = 'select * from client'; 
		return $this->execQuery($requete,null,'Client');
	}

	public function getClientsTri($tri) {
			$requete = "select * from client order by $tri"; 
		return $this->execQuery($requete,null,'Client');
	}

	public function getClientsAdr($adr) {
			 $requete = 'select * from client where adr = ?';
		 return $this->execQuery($requete,array($adr),'Client');
	}

	public function getClient($idcli) {
			 $requete = 'select * from client where ncli = ?';
		 return $this->execQuery($requete,array($idcli),'Client');
	}

	public function insertClient($idcli,$nom,$adr) {
			 $requete = 'insert into client values(?,?,?)';
		 $tparam = array($idcli,$nom,$adr);
		 return $this->execMaj($requete,$tparam);
	}

	public function updateAdrClient($idcli,$adr) {
			 $requete = 'update client set adr = ? where ncli = ?';
		 $tparam = array($adr,$idcli);
		 return $this->execMaj($requete,$tparam);
	}

	public function deleteClient($idcli) {
			 $requete = 'delete from client where ncli = ?';
		 $tparam = array($idcli);
		 return $this->execMaj($requete,$tparam);
	}

	public function getAchats() {
			$requete = 'select * from achat'; 
		return $this->execQuery($requete,null,'Achat');
	}

	public function getAchatsTri($tri) {
			$requete = "select * from achat order by $tri"; 
		return $this->execQuery($requete,null,'Achat');
	}

	public function getProduits() {
			$requete = 'select * from produit'; 
		return $this->execQuery($requete,null,'Produit');
	}

	public function getProduitsTri($tri) {
			$requete = "select * from produit order by $tri"; 
		return $this->execQuery($requete,null,'Produit');
	}

} //fin classe DB

?>