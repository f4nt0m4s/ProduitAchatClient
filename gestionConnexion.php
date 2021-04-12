<?php

//var_dump( $_SERVER['REQUEST_METHOD'] );
//var_dump( $_SERVER );

// define variables and set to empty values ne sont pas visibles à l'intérieur des fonctions
$tabErreurs['login'] 	= $tabErreurs['password'] 	= "";
$login 					= $mdp 						= "";


// Le login fait référence à l'attribut name=login qui est dans le templateConnexion

if ( isset($_REQUEST['login']) )
{
	if ( ! empty($_REQUEST['login']) )
	{
		$login = test_input($_REQUEST['login']);
	}
}

var_dump($_SERVER['REQUEST_METHOD']);

if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	if ( isset($login) )
	{
		if ( empty($_POST['login']) )
		{
			$tabErreurs['login'] = "Nom est requis";
		}
		else
		{
			$login = test_input($_POST['login']);
			
			if ( ! isLoginOK($login) )
			{
				$tabErreurs['login'] = "Nom est incorrecte";
			}
		}
	}
	
	if ( isset($mdp) )
	{
		if ( empty($_POST['password']) )
		{
			$tabErreurs['password'] = "Mot de passe est requis";
		}
		else
		{
			
			$mdp = test_input($_POST['password']);

			if ( ! isMotDePasseOK($_POST['password']) )
			{
				$tabErreurs['password'] = "Mot de passe incorrecte";
			}
		}
	}


	if ( isLoginOK($login) && isMotDePasseOK($mdp) )
	{
		// cree une nouvelle session si la session n'existait pas
		// ou bien récupère une session existante si une session est en cours
		unset($_SESSION);
		session_start();

		// Au lieu de stocker chaque attribut, on utilise un objet Utilisateur
		//$_SESSION['nom']=$nom;
		//$_SESSION['droitAcces'] = niveauDroit($nom);

		include './classes/utilisateur.inc.php';
		$un_utilisateur = new utilisateur($login, $mdp, niveauDroit($login));

		$_SESSION = array();

		// Pour stocker un objet de type Utilisateur, il faut le sérialiser, 
			// c'est-à-dire le traduire en une chaîne de caractères, pour pouvoir le stocker dans une session
		$_SESSION['utilisateur'] = serialize($un_utilisateur);
			
		// Lorsqu'on aura besoin de restituer cette instance, on fera jouer la fonction inverse unserialize()
			// ex : $un_utilisateur=unserialize($_SESSION['utilisateur']);

		header ("Location: accueil.php");
		exit();
	}
	else
	{
		header ("Location: connexion.php");
		exit();
	}
}

function isLoginOK($login) : bool
{
	if ( strcmp($login, 'user') == 0 || strcmp($login, 'admin') == 0 )
	{
		return true;
	}
	return false;
}

function isMotDePasseOK($mdp) : bool
{
	if ( strcmp($mdp, 'userpwd') == 0 )
	{
		return true;
	}

	if ( strcmp($mdp, 'adminpwd') == 0 )
	{
		return true;
	}

	return false;
}

function niveauDroit($nom) : int
{
	if ($nom == 'user') return 1; // droit de consultation
	if ($nom == 'admin')  return 2; // droit de modification
	return 0; // aucun droit
}


function test_input($data) : string
{
	//on supprime les espaces, les sauts de ligne etc.
	$data = trim($data);
	//on supprime les antislashs
	$data = stripslashes($data);
	//on utilise les codes HTML pour les caractéres spéciaux
	$data = htmlspecialchars($data);
	
	return $data;
}

function is_session_started() : bool
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}

	//var_dump($login);
	//var_dump($mdp);

	//var_dump(isLoginOK($login));
	//var_dump(isMotDePasseOK($mdp));
/*
	// Si une session est déja défini 
	if ( isset($_SESSION) || session_status() === PHP_SESSION_ACTIVE || session_id() === '' )
	{
		// Détruit complètement la session et efface également le cookie de session.
		if (ini_get("session.use_cookies")) 
		{
			$params = session_get_cookie_params(); 
			setcookie( 	session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"] );
		}

		if ( is_session_started() )
		{
			// détruit la variable session
			session_unset();

			// détruit la session
			session_destroy();
		}
	}
*/

/*
var_dump( isLoginOK($login) );
var_dump( isMotDePasseOK($mdp) );*/


?>

