<?php

// pour pouvoir utiliser le loader de twig
require_once( "./Twig/lib/Twig/Autoloader.php" );

Twig_Autoloader::register();
// On indique que les templates seront chargés depuis ./templates 
$twig = new Twig_Environment( new Twig_Loader_Filesystem("./templates"));

$tpl = $twig->loadTemplate( "templateConnexion.tpl" );

include_once 'gestionConnexion.php'; // inclure permet de récupérer le contenu mais n'éxécute pas le code

$titre = "Page de connexion";
echo $tpl->render( array("pagetitre" => $titre, "message" => "Veuillez-vous identifier", "identifiant" => $login, "tabErreurs" => $tabErreurs) );


//var_dump( $_SERVER['REQUEST_METHOD'] );
//var_dump( $_SERVER );

?>

