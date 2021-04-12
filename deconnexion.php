<?php 

session_start();
unset($_SESSION);
session_destroy(); //destruction de la session a la prochaine requete

header('Location: connexion.php'); //on renvoie vers le formulaire de connexion
exit();

?>