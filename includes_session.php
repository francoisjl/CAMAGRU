<?php
//session_start();
if(!isset($_SESSION)) {session_start();}

/*	if ($_SERVER['DOCUMENT_ROOT'] == "/Applications/MAMP/htdocs" or $_SERVER['DOCUMENT_ROOT'] == 'C:/wamp64/www')
		define('ROOT', $_SERVER['DOCUMENT_ROOT'] . "/camagru/");
	else
		define('ROOT', $_SERVER['DOCUMENT_ROOT']);
	define('ROOT_UPLD', ROOT.'/upload/');
	define('ROOT_FOND', ROOT.'/fonds/');*/
//	$Domaine_Serveur = str_replace ( 'www.' , '', $_SERVER['HTTP_HOST']);
require_once('config/database.php');
require_once('CSession.class.php');
require_once('CInscription.class.php');
include_once ('CForm.class.php');
include_once ('CPrint.class.php');
// tableau des questions secretes
$Tabquestion = array();
$Tabquestion[] = "Choisir la question secrète...";
$Tabquestion[] = "Le nom de votre chien";
$Tabquestion[] = "Le prénom de votre meilleur ami";
$Tabquestion[] = "Votre nom de jeune fille";
$Tabquestion[] = "Votre sport favori";
?>