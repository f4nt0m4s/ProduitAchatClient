<?php

	include ("fctAux.inc.php");
	// a placer en TOUT debut de CHAQUE PAGE DE L'APPLICATION (consultProduit.php etc.)
	//-------------------------------------------------------
	session_start();

	if(! isset($_SESSION['nom'])) 
	{
		header('Location: connexion.php');
	}
	else
	{
		entete();
		contenu();
		pied();
	}

//-------------------------------------------------------
	function contenu() 
	{
		echo "SUITE<br/>\n";
		$droitAcces = $_SESSION['droitAcces'];
		if ($droitAcces == 1) { echo "droit de consultation <br/> \n"; }
		if ($droitAcces == 2) { echo "droit de modification <br/> \n"; }
		echo "<br/><a href=\"bye.php\"> Déconnexion </a>";
	}
?>