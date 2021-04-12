<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// a placer en TOUT debut de CHAQUE PAGE DE L'APPLICATION (consultProduit.php etc.)
//-------------------------------------------------------
session_start();

if(! isset($_SESSION['utilisateur'])) 
{
	header('Location: connexion.php');
}

include './classes/DB.inc.php';

// pour pouvoir utiliser le loader de twig
require_once( "./Twig/lib/Twig/Autoloader.php" );

Twig_Autoloader::register();
// On indique que les templates seront chargés depuis ./templates 
$twig = new Twig_Environment( new Twig_Loader_Filesystem("./templates"));

// charge le teamplate pour le client
$tpl = $twig->loadTemplate( "templateConsultClients2.tpl" );

$db = DB::getInstance();
$titre = "";
if ($db == null)
{
	echo "Impossible de se connecter à la base de données !";

	// charge le template erreur et l'envoie 
	$tpl = $twig->loadTemplate( "templateErreur.tpl" );
	echo $tpl->render( array("pagetitre" => $titre="Erreur", "erreur" => "Erreur lors de la connexion à la base de données" ) );
}
else // Connexion réussie
{
	try
	{
		$tabClients = $db->getClients();
	}
	catch (Exception $e) 
	{
	      echo $e->getMessage();
	}

	if ( $tabClients == null || empty($tabClients) || count($tabClients) == 0 )
	{
		echo $tpl->render( array("pagetitre" => $titre="Erreur", "erreur" => "Aucun client dans la base de données" ) );
	}
	else
	{
		$titre = "Les clients";
		$nom_script = basename( $_SERVER["SCRIPT_NAME"] );
		$tabNomTuples = array('ncli', 'nom', 'ville'); // le nom des colonnes
		$choix = '';
		$tabParams = '';

		if ( $_SERVER['REQUEST_METHOD'] == 'GET' )
		{
			if ( isset($_GET) )
			{

				// Pour le choix
				if ( isset( $_GET['choix'] ) )
				{
					if ( empty( $_GET['choix'] ) )
					{
						$choix = 'ncli';
					}	 
					else
					{
						$choix = $_GET['choix'];
					}
				}
				else
				{
					$choix = 'ncli';
				}

				// Pour les paramètres du choix
				if ( empty( $_GET ) )
				{
					$tabParams = array('ncli' => '-1');					
				} 
				else
				{
					$tabParams = $_GET;
				}
			}

			// convertit toutes les int en string car param est de type string et pour le comparer à Client->getIdCli qui est de type int
			foreach($tabParams as $cle => $valeur) 
			{
				$tabParams[$cle] = intval($tabParams[$cle]); 
			}

			$tabClients = $db->getClientsTri($choix);
			echo $tpl->render( 
				array("pagetitre" => $titre, "msg" => "Consultation des clients", "nomScript" => $nom_script, "nomTuples" => $tabNomTuples, "items" => $tabClients, "params" => $tabParams) 
				);
		}
	}
	$db->close();
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