<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// a placer en TOUT debut de CHAQUE PAGE DE L'APPLICATION (consultProduit.php etc.)
//-------------------------------------------------------
session_start();

if(! isset($_SESSION['utilisateur'])) 
{
	header('Location: connexion.php');
	exit();
}

// pour pouvoir utiliser le loader de twig
require_once( "./Twig/lib/Twig/Autoloader.php" );

Twig_Autoloader::register();
// On indique que les templates seront chargés depuis ./templates 
$twig = new Twig_Environment( new Twig_Loader_Filesystem("./templates"));

$tpl = $twig->loadTemplate( "templateConsultBase.tpl" );

$titre = "Page d'accueil";
echo $tpl->render( array("pagetitre" => $titre, "titrecentre" => $titre, "msg" => "Bienvenue") );





//-------------------------------------------------------
function contenu() 
{
	echo "SUITE<br/>\n";
	$droitAcces = $_SESSION['droitAcces'];
	if ($droitAcces == 1) { echo "droit de consultation <br/> \n"; }
	if ($droitAcces == 2) { echo "droit de modification <br/> \n"; }
	echo "<br/><a href=\"bye.php\"> Déconnexion </a>";
}

function getTitre($titre, $mdp) : string
{
	if ( strcmp($mdp, 'userpwd') == 0 )
	{
		return $titre = "Connexion en mode utilisateur";
	}

	if ( strcmp($mdp, 'adminpwd') == 0 )
	{
		return $titre = "Connexion en mode administrateur";
	}

	return "";
}

function getMessage($mdp) : string
{
	if ( strcmp($mdp, 'userpwd') == 0 )
	{
		return $message = "bonjour admin";
	}

	if ( strcmp($mdp, 'adminpwd') == 0 )
	{
		return $message = "bonjour admin";
	}

	return "";
}


?>